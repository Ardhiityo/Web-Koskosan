<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room = Room::where('name', 'Family')->first();

        RoomImage::insert([
            [
                'room_id' => $room->id,
                'image' => 'assets/images/thumbnails/room-1.png'
            ],
            [
                'room_id' => $room->id,
                'image' => 'assets/images/thumbnails/room-2.png'
            ],
            [
                'room_id' => $room->id,
                'image' => 'assets/images/thumbnails/room-3.png'
            ],
        ]);
    }
}
