<?php

namespace App\Observers;

use App\Models\BoardingHouse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BoardingHouseObserver
{
    /**
     * Handle the BoardingHouse "created" event.
     */
    public function created(BoardingHouse $boardingHouse): void
    {
        //
    }

    /**
     * Handle the BoardingHouse "updating" event.
     */
    public function updating(BoardingHouse $boardingHouse): void
    {
        // Cek jika field image diubah
        if ($boardingHouse->isDirty('thumbnail')) {
            // Hapus file lama
            if (!is_null($boardingHouse->getOriginal('thumbnail'))) {
                if (Storage::disk('public')->exists($boardingHouse->getOriginal('thumbnail'))) {
                    Storage::disk('public')->delete($boardingHouse->getOriginal('thumbnail'));
                }
            }
        }
    }

    /**
     * Handle the BoardingHouse "deleting" event.
     */
    public function deleting(BoardingHouse $boardingHouse): void
    {
        foreach ($boardingHouse->rooms as $room) {
            foreach ($room->roomImages as $roomImage) {
                $roomImage->delete();
            }
        }

        foreach ($boardingHouse->bonuses as $bonus) {
            $bonus->delete();
        }

        foreach ($boardingHouse->testimonials as $testimonial) {
            $testimonial->delete();
        }
    }

    public function deleted(BoardingHouse $boardingHouse)
    {
        if (Storage::disk('public')->exists($boardingHouse->thumbnail)) {
            Storage::disk('public')->delete($boardingHouse->thumbnail);
        }
    }

    /**
     * Handle the BoardingHouse "restored" event.
     */
    public function restored(BoardingHouse $boardingHouse): void
    {
        //
    }

    /**
     * Handle the BoardingHouse "force deleted" event.
     */
    public function forceDeleted(BoardingHouse $boardingHouse): void
    {
        //
    }
}
