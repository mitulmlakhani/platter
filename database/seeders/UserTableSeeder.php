<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'basic',
            'email' => 'basic@mailinator.com',
            'password' => bcrypt('12345678'),
            'role' => 'basic'
        ]);

        User::create([
            'name' => 'full',
            'email' => 'full@mailinator.com',
            'password' => bcrypt('12345678'),
            'role' => 'full'
        ]);
    }
}
