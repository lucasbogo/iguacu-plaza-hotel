<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupant extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_unit_id', 'name','rg', 'cpf', 'check_in', 'check_out', 'rent_amount', 'paid_rent_amount', 'payment_date', 'transfer_date', 'transfer_reason',

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

    public function drinkConsumables()
    {
        return $this->belongsToMany(DrinkConsumable::class, 'occupant_drink_consumable')
            ->withPivot(['quantity', 'paid'])
            ->withTimestamps();
    }
}
