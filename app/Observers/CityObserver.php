<?php

namespace App\Observers;

use App\Models\City;
use Illuminate\Support\Facades\Storage;

class CityObserver
{
    /**
     * Handle the City "created" event.
     */
    public function created(City $city): void
    {
        //
    }

    /**
     * Handle the City "updating" event.
     */
    public function updating(City $city): void
    {
        // Cek jika field image diubah
        if ($city->isDirty('image')) {
            // Hapus file lama
            if (!is_null($city->getOriginal('image'))) {
                if (Storage::disk('public')->exists($city->getOriginal('image'))) {
                    Storage::disk('public')->delete($city->getOriginal('image'));
                }
            }
        }
    }

    public function deleting(City $city)
    {
        foreach ($city->boardingHouses as $boardingHouse) {
            $boardingHouse->delete();
        }
    }

    /**
     * Handle the City "deleted" event.
     */
    public function deleted(City $city): void
    {
        if (Storage::disk('public')->exists($city->image)) {
            Storage::disk('public')->delete($city->image);
        }
    }

    /**
     * Handle the City "restored" event.
     */
    public function restored(City $city): void
    {
        //
    }

    /**
     * Handle the City "force deleted" event.
     */
    public function forceDeleted(City $city): void
    {
        //
    }
}
