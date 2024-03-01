<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'receptionist_id',
        'message',
        'status',
    ];

    /**
     * Get the receptionist that authored the log.
     */
    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }

    /**
     * Scope a query to only include logs of a specific status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include logs from a specific date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDate($query, $date)
    {
        return $query->whereDate('created_at', '=', $date);
    }
}
