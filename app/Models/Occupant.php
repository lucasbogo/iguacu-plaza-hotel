<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_unit_id', 'name', 'check_in', 'check_out', 'rent_amount', 'payment_date', 'transfer_date', 'transfer_reason',

    ];

    protected $dates = [
        'check_in',
        'check_out',
        'payment_date',
        'transfer_date',
    ];

    public function rentalUnit()
    {
        return $this->belongsTo(RentalUnit::class);
    }

    public function roomServices()
    {
        return $this->hasMany(RoomService::class);
    }
}
