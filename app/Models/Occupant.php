<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    use HasFactory;

    public function rentalUnits()
    {
        return $this->belongsTo(RentalUnit::class);
    }

    public function roomServices()
    {
        return $this->hasMany(RoomService::class);
    }
}
