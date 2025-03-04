<?php

namespace App\Models;

use App\Models\BoardingHouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
