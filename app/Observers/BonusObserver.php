<?php

namespace App\Observers;

use App\Models\Bonus;
use Illuminate\Support\Facades\Storage;

class BonusObserver
{
    /**
     * Handle the Bonus "created" event.
     */
    public function created(Bonus $bonus): void
    {
        //
    }

    /**
     * Handle the Bonus "updating" event.
     */
    public function updating(Bonus $bonus): void
    {
        // Cek jika field image diubah
        if ($bonus->isDirty('image')) {
            // Hapus file lama
            if (!is_null($bonus->getOriginal('image'))) {
                if (Storage::disk('public')->exists($bonus->getOriginal('image'))) {
                    Storage::disk('public')->delete($bonus->getOriginal('image'));
                }
            }
        }
    }

    /**
     * Handle the Bonus "deleted" event.
     */
    public function deleted(Bonus $bonus): void
    {
        if (Storage::disk('public')->exists($bonus->image)) {
            Storage::disk('public')->delete($bonus->image);
        }
    }

    /**
     * Handle the Bonus "restored" event.
     */
    public function restored(Bonus $bonus): void
    {
        //
    }

    /**
     * Handle the Bonus "force deleted" event.
     */
    public function forceDeleted(Bonus $bonus): void
    {
        //
    }
}
