<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'image' => 'assets/images/thumbnails/jawa-barat.jpeg',
            'name' => 'Bandung',
            'slug' => Str::slug('Bandung')
        ]);
    }
}
