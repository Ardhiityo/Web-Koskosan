<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\BoardingHouse;
use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Seeder;

class BoardingHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = City::where('slug', 'bandung')->first();
        $category = Category::where('slug', 'hotels')->first();

        BoardingHouse::create([
            'name' => 'Amaris',
            'slug' => Str::slug('Amaris'),
            'thumbnail' => 'assets/images/thumbnails/hotel.png',
            'city_id' => $city->id,
            'category_id' => $category->id,
            'description' => 'A modern minimalist luxury residence that is comfortable, elegant and natural. Open design, cool every day. Have your dream home now!',
            'address' => 'Jl. A.Yani No. 1, Bandung Jawa Barat'
        ]);
    }
}
