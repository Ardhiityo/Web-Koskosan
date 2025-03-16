<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicPath = public_path('assets/images/thumbnails/bonus-1.png');
        $extenstion = pathinfo($publicPath, PATHINFO_EXTENSION);
        $storedPath = 'bonuses/' . 'bonus-1' . ".$extenstion";

        Storage::disk('public')->put($storedPath, file_get_contents($publicPath));

        $boardingHouse = BoardingHouse::where('slug', 'amaris')->first();

        Bonus::create([
            'boarding_house_id' => $boardingHouse->id,
            'image' => $storedPath,
            'name' => 'Free laundry',
            'description' => 'Enjoy the convenience of free laundry services, up to 1kg per month, included with your stay. Because we believe in making your life a little easier—less hassle, more comfort!'
        ]);
    }
}
