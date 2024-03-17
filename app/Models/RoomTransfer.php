<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupant_id',
        'old_rental_unit_id',
        'new_rental_unit_id',
        'transfer_date',
        'transfer_reason',
    ];

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    public function oldRentalUnit()
    {
        return $this->belongsTo(RentalUnit::class, 'old_rental_unit_id');
    }

    public function newRentalUnit()
    {
        return $this->belongsTo(RentalUnit::class, 'new_rental_unit_id');
    }
}
