<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_type', 'vendor_brand'];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_vendors');
    }
}
