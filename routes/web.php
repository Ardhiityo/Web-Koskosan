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
        Route::get('/',  'find')->name('find-kos');
        Route::post('/',  'findResult')->name('find-kos.result');
    });

    Route::prefix('details')->group(function () {
        Route::get('/{slug}',  'roomDetail')->name('room-detail');
        Route::get('/room-available/{slug}',  'roomAvailable')->name('room-available');
    });
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/booking-check', 'index')
        ->name('booking-check');

    Route::post('/booking/room',   'bookingRoomSave')
        ->name('booking-room-save');

    Route::get('/booking/room',   'bookingRoom')
        ->name('booking-room');

    Route::post('/booking/detail',   'bookingDetail')
        ->name('booking-detail');

    Route::post('/booking/checkout',   'checkout')
        ->name('booking-checkout');

    Route::get('/booking/success', 'success')
        ->name('booking-success');

    Route::post('/booking/mybooking-detail', 'myBookingDetail')
        ->name('booking-mybooking-detail');
});

Route::get('/city/{slug}', [CityController::class, 'index'])
    ->name('city');

Route::get('/category/{slug}', [CategoryController::class, 'index'])
    ->name('category');
