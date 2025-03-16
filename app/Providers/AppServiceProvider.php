<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Room;
use App\Models\Bonus;
use App\Models\Category;
use App\Models\RoomImage;
use App\Models\Testimonial;
use App\Models\BoardingHouse;
use App\Observers\CityObserver;
use App\Observers\RoomObserver;
use App\Observers\BonusObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\URL;
use App\Observers\RoomImageObserver;
use App\Observers\TestimonialObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\BoardingHouseObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //file css, js hanya akan diload jika url ngrok-free.app, dan url asset menjadi https (default ngrok adalah http untuk file css, js)
        if (str_contains(request()->url(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }

        City::observe(CityObserver::class);
        Category::observe(CategoryObserver::class);
        BoardingHouse::observe(BoardingHouseObserver::class);
        Room::observe(RoomObserver::class);
        RoomImage::observe(RoomImageObserver::class);
        Bonus::observe(BonusObserver::class);
        Testimonial::observe(TestimonialObserver::class);
    }
}
