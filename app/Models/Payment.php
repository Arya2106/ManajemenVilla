<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'booking_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'total_pembayaran',
        'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
