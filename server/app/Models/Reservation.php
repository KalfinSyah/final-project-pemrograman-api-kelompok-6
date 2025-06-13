<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'marriage_contract_notes',
        'reception_notes',
        'cashflow_in',
        'cashflow_out',
        'wedding_package'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'reservation_vendors');
    }
}
