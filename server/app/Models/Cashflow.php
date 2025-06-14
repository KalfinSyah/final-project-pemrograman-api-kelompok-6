<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'updated_by',
        'reservation_id',
        'cashflow_type',
        'cashflow_date',
        'cashflow_desc',
        'amount',
    ];

    public const TYPES = [
        'Pendapatan',
        'Pengeluaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
