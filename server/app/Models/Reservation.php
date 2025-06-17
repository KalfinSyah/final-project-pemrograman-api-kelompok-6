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
        'updated_by',
        'wedding_contract_notes',
        'reception_notes',
        'cashflow_in',
        'cashflow_out',
        'wedding_package',
        'wedding_date',
        'reservation_status'
    ];

    public const PACKAGES = [
        'A',
        'B',
        'C',
        'D',
        'E',
    ];

    public const STATUSES = [
        'Pending',
        'Berlangsung',
        'Selesai',
        'Batal',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'reservation_vendors');
    }

    public function cashflows()
    {
        return $this->hasMany(Cashflow::class, 'reservation_id');
    }
    // public function getCashflowInAttribute()
    // {
    //     return $this->cashflows()
    //         ->where('cashflow_type', 'Pendapatan')
    //         ->sum('amount');
    // }
    // public function getCashflowOutAttribute()
    // {
    //     return $this->cashflows()
    //         ->where('cashflow_type', 'Pengeluaran')
    //         ->sum('amount');
    // }
}
