<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean'
        ];
    }
}
