<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierClosingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'receptionist_id',
        'start_amount',
        'end_amount',
        'total_sales',
        'total_cash_received',
        'closed_at',
        'rental_income',
        'drink_income',
        'room_service_income',
    ];

    // Define the relationship with the Receptionist model
    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }

    public function cashRegisterPayments()
    {
        return $this->hasMany(CashRegisterPayment::class);
    }


    // Define a method to calculate specific amounts from related models
    public function calculateSpecificAmounts()
    {
        $rentalIncome = Occupant::whereBetween('payment_date', [$this->created_at, $this->closed_at])
            ->sum('rent_amount');

        $drinkIncome = Occupant::whereBetween('payment_date', [$this->created_at, $this->closed_at])
            ->with('drinkConsumables')
            ->get()
            ->sum(function ($occupant) {
                return $occupant->drinkConsumables->sum('pivot.quantity');
            });

        $roomServiceIncome = RoomService::whereBetween('service_date', [$this->created_at, $this->closed_at])
            ->sum('cost');

        return [
            'rental_income' => $rentalIncome,
            'drink_income' => $drinkIncome,
            'room_service_income' => $roomServiceIncome,
            // Add other income categories as needed
        ];
    }
}
