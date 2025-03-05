<?php

namespace App\Services\Repositories;

use App\Models\Room;
use App\Services\Interface\RoomService;

class RoomRepository implements RoomService
{
    public function getRoomById($id)
    {
        return Room::find($id);
    }
}
