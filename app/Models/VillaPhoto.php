<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaPhoto extends Model
{

    use HasFactory;

    protected $fillable = [
        'villa_id',
        'foto',
        'status',
        'keterangan'
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

}
