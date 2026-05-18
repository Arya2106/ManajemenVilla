<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    use HasFactory;

    protected $fillable = [
        'villa_id',
        'guest_id',
        'tanggal_checkin',
        'tanggal_checkout',
        'status',
        'catatan',
        'jumlah_tamu',
        'total_harga',
    ];

    protected $casts = [
    'tanggal_checkin'  => 'datetime',
    'tanggal_checkout' => 'datetime',
];

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
