<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalUnit extends Model
{
    use HasFactory;

    public function occupants()
    {
        return $this->hasMany(Occupant::class);
    }
}
