<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'localizator',
        'discount',
        'discount_mode',
        'limit',
        'limit_mode',
        'dthr_validate',
        'active'
    ];
}
