<?php

namespace App\Providers;

use App\Services\Interface\CityService;
use App\Services\Interface\RoomService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interface\CategoryService;
use App\Services\Repositories\CityRepository;
use App\Services\Repositories\RoomRepository;
use App\Services\Interface\TransactionService;
use App\Services\Interface\BoardingHouseService;
use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\TransactionRepository;
use App\Services\Repositories\BoardingHouseRepository;

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
        $this->app->bind(RoomService::class, RoomRepository::class);
        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionRepository($app->make(RoomService::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
