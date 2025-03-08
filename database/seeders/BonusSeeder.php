<?php

namespace Database\Seeders;

use App\Models\BoardingHouse;
use App\Models\Bonus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardingHouse = BoardingHouse::where('slug', 'amaris')->first();

        Bonus::create([
            'boarding_house_id' => $boardingHouse->id,
            'image' => 'assets/images/thumbnails/bonus-1.png',
            'name' => 'Free laundry',
            'description' => 'Enjoy the convenience of free laundry services, up to 1kg per month, included with your stay. Because we believe in making your life a little easier—less hassle, more comfort!'
        ]);
    }
}
