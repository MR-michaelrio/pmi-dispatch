<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $table = 'ambulances';

    protected $fillable = [
        'code',
        'plate_number',
        'type',
        'status',
        'last_location',
    ];
}
