<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        User::create([
            'name' => 'administrador2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
