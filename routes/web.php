<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PopularController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\AllBoardingHouseController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(BoardingHouseController::class)->group(function () {
    Route::prefix('find-kos')->group(function () {
        Route::get('/',  'find')->name('find-kos');
        Route::post('/',  'findResult')->name('find-kos.result');
    });

    Route::prefix('details')->group(function () {
        Route::get('/{slug}',  'roomDetail')->name('room-detail');
        Route::get('/room-available/{slug}',  'roomAvailable')->name('room-available');
    });
});

Route::controller(BookingController::class)->group(function () {
    Route::prefix('booking')->group(function () {
        Route::get('/check', 'index')
            ->name('booking-check');

        Route::post('/room',   'bookingRoomSave')
            ->name('booking-room-save');

        Route::get('/room',   'bookingRoom')
            ->name('booking-room');

        Route::post('/detail',   'bookingDetail')
            ->name('booking-detail');

        Route::post('/checkout',   'checkout')
            ->name('booking-checkout');

        Route::get('/success', 'success')
            ->name('booking-success');

        Route::post('/mybooking-detail', 'myBookingDetail')
            ->name('booking-mybooking-detail');
    });
});

Route::controller(CityController::class)->group(function () {
    Route::get('/city/{slug}',  'show')
        ->name('city');

    Route::get('/cities', 'index')
        ->name('cities');
});

Route::get('/category/{slug}', [CategoryController::class, 'index'])
    ->name('category');

Route::get('/popular', [PopularController::class, 'index'])
    ->name('popular');

Route::get('/all-boarding-house', [AllBoardingHouseController::class, 'index'])
    ->name('all-boardingHouse');
