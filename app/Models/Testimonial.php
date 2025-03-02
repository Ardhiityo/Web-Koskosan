<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
