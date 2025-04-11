<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;
use App\Services\Interface\RoomService;

class BoardingHouseController extends Controller
{
    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository,
        private RoomService $roomRepository
    ) {}

    public function find()
    {
        $cities = $this->cityRepository->getAllCities();

        $categories = $this->categoryRepository->getAllCategories();

        return view('pages.boarding-house.find', compact('cities', 'categories'));
    }

    public function findResult(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses(
            search: $request->name,
            city: $request->city,
            category: $request->category
        );

        return view('pages.boarding-house.find-result', compact('boardingHouses'));
    }

    public function roomDetail($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);

        $averageRating = $boardingHouse->testimonials->avg('rating');

        return view('pages.boarding-house.detail', compact('boardingHouse', 'averageRating'));
    }

    public function roomAvailable($slug)
    {
        $boardingHouse = $this->boardingHouseRepository->getBoardingHouseBySlug($slug);

        return view('pages.boarding-house.room-available', compact('boardingHouse'));
    }
}
