<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function staffs()
    {
        return $this->hasMany(WeddingStaff::class);
    }

    public function rundowns()
    {
        return $this->hasMany(WeddingRundown::class);
    }

    public function calenders()
    {
        return $this->hasMany(Calender::class);
    }

    public function cashflows()
    {
        return $this->hasMany(Cashflow::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'reservation_vendors');
    }
}
