<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'updated_by',
        'reservation_id',
        'activity_type',
        'activity_name',
        'activity_date',
        'activity_desc',
        'activity_status',
    ];

    public const TYPES = [
        'Reservasi Lokasi',
        'Pemesanan Katering',
        'Koordinasi Staff',
        'Pelaksanaan Acara',
    ];

    public const STATUSES = [
        'Pending',
        'Selesai',
        'Batal',
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
