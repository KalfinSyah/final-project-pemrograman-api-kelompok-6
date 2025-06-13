<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'activity_type',
        'activity_name',
        'activity_date',
        'activity_desc',
        'activity_status',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
