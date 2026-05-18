<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'nama',
        'nomor_telpon',
        'nomor_ktp',
        'foto_ktp'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
