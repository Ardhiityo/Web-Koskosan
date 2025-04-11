<?php

namespace App\Services\Repositories;

use App\Models\Category;
use App\Services\Interface\CategoryService;

class CategoryRepository implements CategoryService
{
    public function getAllCategories()
    {
        return Category::with('boardingHouses')->get();
    }
}
