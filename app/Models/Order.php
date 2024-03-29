<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $primaryKey = 'id';
    public $timeStamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\Models\OrderProduct', 'order_id');
    }

    public function getTotalOrderPrice($user, $currency)
    {
        if ($user === null) return null;
        if ($currency === null) return null;
        $total_price = 0;
        $order = $this;
        foreach ($order->orderProducts as $order_product) {
            if ($order_product->currency == $currency) {
                $total_price += $order_product->getTotalPrice($user);
            }
        }
        return $total_price;
    }

    public function getStatus()
    {
        $order = $this;
        if (app()->getLocale() == 'ru') {
            switch ($order->status) {
                case 0:
                    return 'Незаконченный';
                case 1:
                    return 'Отправлено';
                case 2:
                    return 'Подтвердил';
                default:
                    return 'undefined';
            }
        } else {
            switch ($order->status) {
                case 0:
                    return 'Placing';
                case 1:
                    return 'Submitted';
                case 2:
                    return 'Confirmed';
                default:
                    return 'undefined';
            }
        }
    }

    public function attachQuantities($products)
    {
        if ($products === null) return null;
        return $products->map(function($product) {
            return $this->attachQuantity($product);
        });
    }

    public function attachQuantity($product)
    {
        if ($product === null) return null;
        $orderProduct = $this->orderProducts->where('product_id', $product->id)->first();
        if ($orderProduct !== null) {
            $product->quantity = $orderProduct->quantity;
        } else $product->quantity = 0;
        return $product;
    }

    public function safeDelete()
    {
        $orderProducts = $this->orderProducts;
        foreach ($orderProducts as $orderProduct) {
            $orderProduct->delete();
        }
        $this->delete();
    }
}
