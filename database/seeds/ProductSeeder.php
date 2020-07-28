<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'name' => 'Caneca personalizada 200ml',
            'description' => 'Caneca em porcelana com frases bíblicas',
            'price' => 8.99,
            'active' => 'Y'
        ]);
        App\Product::create([
            'name' => 'Caneca personalizada 400ml',
            'description' => 'Caneca em porcelana com emblemas de times de futebol',
            'price' => 11.99,
            'active' => 'Y'
        ]);
    }
}
