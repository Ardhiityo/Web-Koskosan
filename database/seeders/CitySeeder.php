<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path('assets/images/thumbnails/jawa-barat.jpeg');
        $extenstion = pathinfo($publicPath, PATHINFO_EXTENSION);
        $storedPath = 'cities/' . 'jawa-barat' . ".$extenstion";

        Storage::disk('public')->put($storedPath, file_get_contents($publicPath));

        City::create([
            'image' => $storedPath,
            'name' => 'Bandung',
            'slug' => Str::slug('Bandung')
        ]);
    }
}
