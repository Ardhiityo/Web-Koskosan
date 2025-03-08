<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
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

    public function index(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses(city: $request->city);

        return view('pages.city.index', compact('boardingHouses'));
    }
}
