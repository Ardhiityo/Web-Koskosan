<?php

namespace App\Observers;

use App\Models\Room;
use Illuminate\Support\Facades\Log;

class RoomObserver
{
    /**
     * Handle the Room "created" event.
     */
    public function created(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "updated" event.
     */
    public function updated(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "deleting" event.
     */
    public function deleting(Room $room): void
    {
        foreach ($room->roomImages as $roomImage) {
            $roomImage->delete();
        }
    }

    /**
     * Handle the Room "restored" event.
     */
    public function restored(Room $room): void
    {
        //
    }

    /**
     * Handle the Room "force deleted" event.
     */
    public function forceDeleted(Room $room): void
    {
        //
    }
}
