<?php

namespace App\Services\Repositories;

use App\Models\BoardingHouse;
use App\Services\Interface\BoardingHouseService;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseService
{
    function getAllBoardingHouses($search = null, $city = null, $category = null)
    {
        $boardingHouses = BoardingHouse::with('city', 'rooms', 'testimonials');

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
        try {
            return BoardingHouse::with([
                'testimonials',
                'category',
                'rooms' => ['roomImages'],
                'category',
                'bonuses',
                'city'
            ])->where('slug',  'like',  '%' . $slug . '%')->firstOrFail();
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::with('city', 'category', 'rooms', 'testimonials')->withCount('transactions')
            ->orderByDesc('transactions_count')->get();
    }

    function getBoardingHouseById($id)
    {
        try {
            return BoardingHouse::with('city', 'category')->findOrFail($id);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
