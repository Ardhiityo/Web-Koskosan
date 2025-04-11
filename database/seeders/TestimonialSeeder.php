<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialSeeder extends Seeder
{

    public function storedImage($path)
    {
        $publicPath = public_path($path);
        $extenstion = pathinfo($publicPath, PATHINFO_EXTENSION);
        $storedPath = 'room-images/' . uniqid() . ".$extenstion";

        Storage::disk('public')->put($storedPath, file_get_contents($publicPath));

        return $storedPath;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardingHouse = BoardingHouse::first();

        Testimonial::create([
            'boarding_house_id' => $boardingHouse->id,
            'name' => 'Arya',
            'photo' => $this->storedImage('assets/images/photos/sami.png'),
            'content' => 'okeeee',
            'rating' => 3
        ]);
    }
}
