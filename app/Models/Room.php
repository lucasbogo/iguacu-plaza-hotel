<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Room extends Model
{

    protected $fillable = [
        // your other fields,
        'status',
    ];

    public function rRoomImage()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(\App\Models\Amenity::class);
    }
}
