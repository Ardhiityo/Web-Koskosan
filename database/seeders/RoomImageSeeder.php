<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomImageSeeder extends Seeder
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
        $room = Room::where('name', 'Family')->first();

        RoomImage::insert([
            [
                'room_id' => $room->id,
                'image' => $this->storedImage('assets/images/thumbnails/room-1.png')
            ],
            [
                'room_id' => $room->id,
                'image' => $this->storedImage('assets/images/thumbnails/room-2.png')
            ],
            [
                'room_id' => $room->id,
                'image' => $this->storedImage('assets/images/thumbnails/room-3.png')
            ],
        ]);
    }
}
