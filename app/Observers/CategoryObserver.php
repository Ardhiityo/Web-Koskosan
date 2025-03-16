<?php

namespace App\Observers;

use App\Models\BoardingHouse;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category): void
    {
        if ($category->isDirty('image')) {
            if (!is_null($category->getOriginal('image'))) {
                if (Storage::disk('public')->exists($category->getOriginal('image'))) {
                    Storage::disk('public')->delete($category->getOriginal('image'));
                }
            }
        }
    }

    public function deleting(Category $category)
    {
        foreach ($category->boardingHouses as $boardingHouse) {
            $boardingHouse->delete();
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        if (Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
