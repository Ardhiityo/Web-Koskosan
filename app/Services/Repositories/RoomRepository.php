<?php

namespace App\Services\Repositories;

use App\Models\Room;
use App\Services\Interface\RoomService;

class RoomRepository implements RoomService
{
    public function getRoomById($id)
    {
        try {
            return Room::findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
