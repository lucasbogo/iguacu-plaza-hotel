<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkConsumable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'quantity'
    ];

    public function occupants()
    {
        return $this->belongsToMany(Occupant::class, 'occupant_drink_consumable', 'drink_consumable_id', 'occupant_id')
            ->withTimestamps();
    }
}
