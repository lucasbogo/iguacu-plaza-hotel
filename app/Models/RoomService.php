<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomService extends Model
{
    use HasFactory;

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
