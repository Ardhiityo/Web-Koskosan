<?php

namespace App\Services\Repositories;

use App\Models\BoardingHouse;
use App\Services\Interface\BoardingHouseService;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseService
{
    function getAllBoardingHouses($search = null, $city = null, $category = null)
    {
        $boardingHouses = BoardingHouse::query();

        if ($search) {
            $boardingHouses->where('name', 'like', '%' . $search . '%');
        }

        if ($city) {
            $boardingHouses->whereHas('city', function (Builder $query) use ($city) {
                $query->where('name', $city);
            });
        }

        if ($category) {
            $boardingHouses->whereHas('category', function (Builder $query) use ($category) {
                $query->where('name', $category);
            });
        }

        return $boardingHouses->get();
    }

    function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('category', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::where('slug',  'like',  '%' . $slug . '%')->first();
    }

    function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')
            ->orderByDesc('transactions_count')->get();
    }

    function getBoardingHouseById($id)
    {
        return BoardingHouse::find($id);
    }
}
