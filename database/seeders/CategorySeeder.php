<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path('assets/images/thumbnails/hotel.png');
        $extenstion = pathinfo($publicPath, PATHINFO_EXTENSION);
        $storedPath = 'categories/' . 'hotel' . ".$extenstion";

        Storage::disk('public')->put($storedPath, file_get_contents($publicPath));

        Category::create([
            'image' => $storedPath,
            'name' => 'Hotels',
            'slug' => Str::slug('Hotels')
        ]);
    }
}
