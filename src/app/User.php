<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Discount;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email_h', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getEmailAttribute($value){
        if (auth()->user() && (auth()->user()->isAdmin() || auth()->user()->id === $this->id))
            return decrypt($value);
        else return null;
    }
    public function getRoleAttribute($value){ 
        return decrypt($value);
    }
    public function getNameAttribute($value){
        if (auth()->user() && (auth()->user()->isAdmin() || auth()->user()->id === $this->id))
            return decrypt($value);
        else return null;
    }

    public function isAdmin(){
        return $this->role === 'admin';
    }

    public function isClient(){
        return $this->role === 'client' && $this->is_new == 0;
    }
    
    public function isNewClient(){
        return $this->role === 'client' && $this->is_new == 1;
    }

    public function getAllDiscounts(){
        $user = $this;
        if (!($user->isClient() || $user->isNewClient())) return null;
        $discounts = Discount::where('user_id', $user->id)->get();
        return $discounts;
    }

    public function getDiscount($subcategory){
        $user = $this;
        if (!($user->isClient() || $user->isNewClient())) return null;
        $discount = $user->getAllDiscounts()->where('subcategory_id', $subcategory->id)->first();

        // Check if general subcategory discount is bigger than user's personal discount
        if ($subcategory->discount > 0 && ($discount === null || $subcategory->discount > $discount->discount)) 
            return $subcategory->discount;

        if ($discount === null) return 0;
        return $discount->discount;
    }
}
