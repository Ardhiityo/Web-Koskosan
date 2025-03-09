<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;

class CityController extends Controller
{
    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository
    ) {}

    public function index()
    {
        $cities = $this->cityRepository->getAllCities();

        foreach ($cities as $city) {
            $averageRating = $city->boardingHouses()
                ->with('testimonials')
                ->get()
                ->pluck('testimonials')
                ->flatten()
                ->avg('rating');
        }

        return view(
            view: 'pages.city.index',
            data: compact('cities', 'averageRating')
        );
    }

    public function show(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses(city: $request->city);

        return view(
            view: 'pages.city.show',
            data: compact('boardingHouses')
        );
    }
}
