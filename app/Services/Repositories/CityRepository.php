<?php

namespace App\Services\Repositories;

use App\Models\City;
use App\Services\Interface\CityService;

class CityRepository implements CityService
{
    public function getAllCities()
    {
        return City::all();
    }
}
