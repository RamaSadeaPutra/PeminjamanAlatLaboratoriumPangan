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
            ['email' => 'admintekpang@mail.unpas.ac.id'],
            [
                'name' => 'Admin Laboratorium',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        User::updateOrCreate(
            ['email' => 'ramasadea@mail.unpas.ac.id'],
            [
                'name' => 'Rama Sadea Putra',
                'nim' => '233040122',
                'password' => Hash::make('rama123'),
                'role' => 'user',
                'status' => 'active',
            ]
        );
    }
}
