<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lab;
class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    Lab::create([
        'lab_name' => 'Laboratorium Pangan',
        'location' => 'Gedung Fakultas Teknik',
        'description' => 'Laboratorium untuk praktikum dan penelitian pangan'
    ]);
}
}
