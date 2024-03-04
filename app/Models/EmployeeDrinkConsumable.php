<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDrinkConsumable extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'drink_consumable_id', 'quantity', 'employee_price', 'paid'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function drinkConsumable()
    {
        return $this->belongsTo(DrinkConsumable::class);
    }
}
