<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id', 'product_id', 'coupon_id', 'value', 'qtd', 'discount'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getTotal()
    {
        return $this->value * $this->qtd - $this->discount;
    }

}
