<?php

namespace App\Http\Controllers;

use App\Services\Interface\BoardingHouseService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\CityService;

class HomeController extends Controller
{
    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository
    ) {}

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $popularBoardingHouses = $this->boardingHouseRepository->getPopularBoardingHouses();
        $cities = $this->cityRepository->getAllCities();
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses();

        return view('pages.home', compact('categories', 'popularBoardingHouses', 'cities', 'boardingHouses'));
    }
}
