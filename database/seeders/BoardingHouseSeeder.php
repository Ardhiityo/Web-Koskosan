<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BoardingHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path('assets/images/thumbnails/hotel.png');
        $extenstion = pathinfo($publicPath, PATHINFO_EXTENSION);
        $storedPath = 'thumbnails/' . 'hotel' . ".$extenstion";

        Storage::disk('public')->put($storedPath, file_get_contents($publicPath));

        $city = City::where('slug', 'bandung')->first();
        $category = Category::where('slug', 'hotels')->first();

        BoardingHouse::create([
            'name' => 'Amaris',
            'slug' => Str::slug('Amaris'),
            'thumbnail' => $storedPath,
            'city_id' => $city->id,
            'category_id' => $category->id,
            'description' => 'A modern minimalist luxury residence that is comfortable, elegant and natural. Open design, cool every day. Have your dream home now!',
            'address' => 'Jl. A.Yani No. 1, Bandung Jawa Barat'
        ]);
    }
}
