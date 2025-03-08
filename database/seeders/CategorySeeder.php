<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'image' => 'assets/images/thumbnails/hotel.png',
            'name' => 'Hotels',
            'slug' => Str::slug('Hotels')
        ]);
    }
}
