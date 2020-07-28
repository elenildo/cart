<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Root',
            'email' => 'teste@teste.com',
            'password' => bcrypt('123123123')
        ]);
    }
}
