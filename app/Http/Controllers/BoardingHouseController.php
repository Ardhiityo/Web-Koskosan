<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;

class BoardingHouseController extends Controller
{
    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository
    ) {}

    public function index()
    {
        $cities = $this->cityRepository->getAllCities();

        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.boarding-house.find', compact('cities', 'categories'));
    }

    public function show($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);

        $averageRating = BoardingHouse::find($boardingHouse->id)->testimonials()->avg('rating');

        return view('pages.boarding-house.show', compact('boardingHouse', 'averageRating'));
    }

    public function store(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses(
            search: $request->name,
            city: $request->city,
            category: $request->category
        );

        return view('pages.boarding-house.store', compact('boardingHouses'));
    }

    public function room($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);

        return view('pages.boarding-house.room', compact('boardingHouse'));
    }
}
