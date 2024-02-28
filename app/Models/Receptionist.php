<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receptionist extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    // Define your model's attributes here, for example:
    protected $fillable = [
        'username', 'name', 'password'  // Add other attributes you need
    ];

    public function cashRegisterPayments()
    {
        return $this->hasMany(CashRegisterPayment::class);
    }
}
