<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama',
        'kapasitas',
        'harga_permalam',
        'status',
        'jumlah_kamar',
        'keterangan'
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function villa_photos()
    {
        return $this->hasMany(VillaPhoto::class);
    }

}
