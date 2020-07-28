<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Order::create([
            'user_id' => 1,
            'status' => 'RE'
        ]);
    }
}
