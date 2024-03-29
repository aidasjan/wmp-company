<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelatedProduct extends Model
{
    use HasFactory;

    protected $table = 'related_products';
    public $primaryKey = 'id';
    public $timeStamps = true;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function getProduct()
    {
        $related_product = $this;
        return Product::find($related_product->related_product_id);
    }
}
