<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'plate_number',
        'status',
        'latitude',
        'longitude',
        'last_location_update',
    ];

    protected $casts = [
        'last_location_update' => 'datetime',
    ];

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class, 'ambulance_id');
    }
}
