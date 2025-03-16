<?php

namespace App\Observers;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialObserver
{
    /**
     * Handle the Testimonial "created" event.
     */
    public function created(Testimonial $testimonial): void
    {
        //
    }

    /**
     * Handle the Testimonial "updating" event.
     */
    public function updating(Testimonial $testimonial): void
    {
        // Cek jika field image diubah
        if ($testimonial->isDirty('photo')) {
            // Hapus file lama
            if (!is_null($testimonial->getOriginal('photo'))) {
                if (Storage::disk('public')->exists($testimonial->getOriginal('photo'))) {
                    Storage::disk('public')->delete($testimonial->getOriginal('photo'));
                }
            }
        }
    }

    /**
     * Handle the Testimonial "deleted" event.
     */
    public function deleted(Testimonial $testimonial): void
    {
        if (Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }
    }

    /**
     * Handle the Testimonial "restored" event.
     */
    public function restored(Testimonial $testimonial): void
    {
        //
    }

    /**
     * Handle the Testimonial "force deleted" event.
     */
    public function forceDeleted(Testimonial $testimonial): void
    {
        //
    }
}
