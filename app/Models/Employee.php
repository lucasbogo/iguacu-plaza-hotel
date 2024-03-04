<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function drinkConsumables()
    {
        return $this->belongsToMany(DrinkConsumable::class, 'employee_drink_consumables')
            ->withPivot(['quantity', 'employee_price', 'paid'])
            ->withTimestamps();
    }
}
