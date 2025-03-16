<?php

namespace App\Observers;

use App\Models\RoomImage;
use Illuminate\Support\Facades\Storage;

class RoomImageObserver
{
    /**
     * Handle the RoomImage "created" event.
     */
    public function created(RoomImage $roomImage): void
    {
        //
    }

    /**
     * Handle the RoomImage "updating" event.
     */
    public function updating(RoomImage $roomImage): void
    {
        // Cek jika field image diubah
        if ($roomImage->isDirty('image')) {
            // Hapus file lama
            if (!is_null($roomImage->getOriginal('image'))) {
                if (Storage::disk('public')->exists($roomImage->getOriginal('image'))) {
                    Storage::disk('public')->delete($roomImage->getOriginal('image'));
                }
            }
        }
    }

    /**
     * Handle the RoomImage "deleted" event.
     */
    public function deleted(RoomImage $roomImage): void
    {
        if (Storage::disk('public')->exists($roomImage->image)) {
            Storage::disk('public')->delete($roomImage->image);
        }
    }

    /**
     * Handle the RoomImage "restored" event.
     */
    public function restored(RoomImage $roomImage): void
    {
        //
    }

    /**
     * Handle the RoomImage "force deleted" event.
     */
    public function forceDeleted(RoomImage $roomImage): void
    {
        //
    }
}
