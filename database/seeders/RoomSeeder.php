<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardingHouse = BoardingHouse::where('slug', 'amaris')->first();

        Room::create([
            'boarding_house_id' => $boardingHouse->id,
            'name' => 'Family',
            'room_type' => 'Extra large space',
            'square_feet' => '30x40',
            'capacity' => 5,
            'price_per_month' => 550000,
            'is_available' => true
        ]);
    }
}
