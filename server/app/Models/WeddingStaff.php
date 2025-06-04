<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingStaff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'wedding_staffs';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
