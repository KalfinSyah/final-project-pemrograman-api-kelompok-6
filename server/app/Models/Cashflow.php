<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id', 'cashflow_type', 'amount'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
