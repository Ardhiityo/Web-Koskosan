<?php

namespace App\Providers;

use App\Services\Interface\CityService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;
use App\Services\Repositories\BoardingHouseRepository;
use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\CityRepository;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BoardingHouseService::class, BoardingHouseRepository::class);
        $this->app->bind(CategoryService::class, CategoryRepository::class);
        $this->app->bind(CityService::class, CityRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
