<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    protected $table = 'dispatches';

    protected $fillable = [
        'patient_name',
        'patient_condition',
        'patient_phone',
        'pickup_address',
        'driver_id',
        'ambulance_id',
        'status',
        'assigned_at',
        'pickup_at',
        'hospital_at',
        'completed_at',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}
