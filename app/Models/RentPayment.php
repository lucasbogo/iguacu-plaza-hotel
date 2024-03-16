<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'occupant_id',
        'amount',
        'payment_date',
        'cashier_closing_record_id',
    ];

    /**
     * Get the occupant that made the rent payment.
     */
    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    /**
     * Get the cashier closing record associated with the rent payment.
     */
    public function cashierClosingRecord()
    {
        return $this->belongsTo(CashierClosingRecord::class);
    }
}
