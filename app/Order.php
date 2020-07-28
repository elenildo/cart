<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = ['id', 'user_id', 'value', 'status'];

    public function order_products()
    {
        // return $this->hasMany('App\OrderProduct')->select(DB::raw(
        //     'product_id, sum(discount) as discounts, sum(value) as values'
        // ))->groupBy('product_id')->orderBy('product_id', 'desc');

        // return DB::table('order_products')->select('product_id, value, qtd, discount', DB::raw('value * qtd as values'))->get();

        return $this->hasMany('App\OrderProduct');
            
    }

}
