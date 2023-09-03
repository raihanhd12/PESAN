<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::factory()->create([
            'name' => 'Infrastruktur',
            'slug' => 'Infrastruktur',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Lingkungan',
            'slug' => 'lingkungan',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Layanan Publik',
            'slug' => 'layanan-publik',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Keamanan',
            'slug' => 'Keamanan',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Lain-lain',
            'slug' => 'lain-lain',
        ]);
    }
}
