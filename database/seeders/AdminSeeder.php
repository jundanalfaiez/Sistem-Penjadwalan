<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com', // Ganti dengan email Super Admin
            'password' => Hash::make('password123'), // Ganti dengan password yang diinginkan
            'role' => 'Super Admin',
        ]);
    }
}

