<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin123@labpangan.test'],
            [
                'name' => 'Admin Laboratorium',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user123@labpangan.test'],
            [
                'name' => 'User Laboratorium',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status' => 'active',
            ]
        );
    }
}
