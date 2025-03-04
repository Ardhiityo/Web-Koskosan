<?php

use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(BoardingHouseController::class)->group(function () {
    Route::prefix('find-kos')->group(function () {
        Route::get('/',  'index')->name('find-kos');
        Route::post('/',  'store')->name('find-kos.store');
    });

    Route::prefix('details')->group(function () {
        Route::get('/{slug}',  'show')->name('detail');
        Route::get('/room-available/{slug}',  'room')->name('room-available');
    });
});

Route::get('/check-booking', [BookingController::class, 'index'])
    ->name('check-booking');

Route::get('/city/{slug}', [CityController::class, 'index'])
    ->name('city');

Route::get('/category/{slug}', [CategoryController::class, 'index'])
    ->name('category');
