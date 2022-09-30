<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);
        
        User::create([
            'name' => 'user',
            'email' => 'user@mail.ru',
            'password' => bcrypt('12345678'),
        ]);
    }
}
