<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interface\CityService;
use App\Services\Interface\CategoryService;
use App\Services\Interface\BoardingHouseService;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryRepository,
        private BoardingHouseService $boardingHouseRepository,
        private CityService $cityRepository
    ) {}

    public function index(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository
            ->getAllBoardingHouses(category: $request->category);

        return view(
            view: 'pages.category.index',
            data: compact('boardingHouses')
        );
    }
}
