<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTransfer extends Model
{
    use HasFactory;

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    // Assuming you want to track both old and new rental units
    public function oldRentalUnit()
    {
        return $this->belongsTo(RentalUnit::class, 'old_rental_unit_id');
    }

    public function newRentalUnit()
    {
        return $this->belongsTo(RentalUnit::class, 'new_rental_unit_id');
    }
}
