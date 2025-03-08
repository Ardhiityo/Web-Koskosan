<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
    }
}
