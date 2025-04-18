<?php

namespace App\Services\Interface;

interface BoardingHouseService
{
    public function getAllBoardingHouses($search = null, $city = null, $category = null);
    public function getPopularBoardingHouses($limit = 5);
    public function getBoardingHouseByCitySlug($slug);
    public function getBoardingHouseByCategorySlug($slug);
    public function getBoardingHouseBySlug($slug);
    public function getBoardingHouseById($id);
}
