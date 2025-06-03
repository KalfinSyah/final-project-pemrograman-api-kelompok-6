<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function weddingStaff()
    {
        return $this->belongsTo(WeddingStaff::class);
    }
}
