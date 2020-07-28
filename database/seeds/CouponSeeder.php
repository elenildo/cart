<?php

use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       App\Coupon::create([
        'name' => Str::random(10),
        'localizator' => Str::random(5),
        'discount' => 5,
        'discount_mode' => 'perc',
        'limit' => 0,
        'limit_mode' => 'qtd',
        'dthr_validate' => date("Y-m-d H:i:s"),
        'active' => 'Y'
       ]);
    }
}
