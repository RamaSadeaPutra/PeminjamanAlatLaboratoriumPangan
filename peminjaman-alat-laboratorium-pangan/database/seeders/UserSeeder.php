<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin123@labpangan.test'],
            [
                'name' => 'Admin Laboratorium',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user123@labpangan.test'],
            [
                'name' => 'User Laboratorium',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::create([
        'name' => 'Admin Laboratorium',
        'email' => 'admin@labpangan.test',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);
}
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
}
