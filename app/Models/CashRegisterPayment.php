<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegisterPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_closing_record_id',
        'receptionist_id',
        'rent_amount',
        'drink_amount',
        'room_service_amount',
        // Add more attributes as needed (e.g., credit_amount, debit_amount, pix_amount)
    ];

    protected $table = 'cash_register_payments';

    public function cashierClosingRecord()
    {
        return $this->belongsTo(CashierClosingRecord::class);
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }
}
