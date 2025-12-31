<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToolCategory;

class ToolCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $categories = [
        'Alat Kadar Air',
        'Alat Kadar Klorida (CL)',
        'Alat Analisis Buah Dan Sayur',
        'Alat Analisis Telur',
    ];

    foreach ($categories as $category) {
        ToolCategory::create([
            'category_name' => $category,
            'description' => null
        ]);
    }
}
}
