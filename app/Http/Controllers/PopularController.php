<?php

namespace App\Http\Controllers;

use App\Services\Interface\BoardingHouseService;

class PopularController extends Controller
{
    public function __construct(private BoardingHouseService $boardingHouseRepository) {}

    public function index()
    {
        $boardingHouses = $this->boardingHouseRepository->getPopularBoardingHouses();
        return view(
            view: 'pages.popular.index',
            data: compact('boardingHouses')
        );
    }
}
