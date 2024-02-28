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
        'closed_at'
    ];

    // Define the relationship with the Receptionist model
    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }
}
