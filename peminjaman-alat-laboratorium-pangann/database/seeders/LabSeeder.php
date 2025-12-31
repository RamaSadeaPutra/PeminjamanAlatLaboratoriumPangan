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
    Lab::insert([
    [
        'lab_name' => 'Laboratorium Analisis Pangan',
        'location' => 'Gedung Fakultas Teknik',
        'description' => 'Laboratorium untuk praktikum dan penelitian pangan',
    ],
    [
        'lab_name' => 'Laboratorium Pengetahuan Bahan Pangan',
        'location' => 'Gedung Fakultas MIPA',
        'description' => 'Laboratorium analisis dan praktikum Pengetahuan Bahan Pangan',
    ],
 
]);

}
}
