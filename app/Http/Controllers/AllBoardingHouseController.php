<?php

namespace App\Http\Controllers;

use App\Services\Interface\BoardingHouseService;

class AllBoardingHouseController extends Controller
{
    public function __construct(private BoardingHouseService $boardingHouseRepository) {}

    public function index()
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses();

        return view('pages.all-boarding-house.index', compact('boardingHouses'));
    }
}
