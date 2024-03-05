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
        'quantity',
        'employee_price',
    ];

    public function occupants()
    {
        return $this->belongsToMany(Occupant::class, 'occupant_drink_consumable', 'drink_consumable_id', 'occupant_id')
            ->withPivot(['quantity', 'paid'])
            ->withTimestamps();
    }

    public function employees()
    {
        // Correct relationship for a many-to-many connection
        return $this->belongsToMany(Employee::class, 'employee_drink_consumables', 'drink_consumable_id', 'employee_id')
            ->withPivot(['quantity', 'paid'])
            ->withTimestamps();
    }


    public function lastUpdatedBy()
    {
        return $this->belongsTo(Receptionist::class, 'last_updated_by_receptionist_id');
    }
}
