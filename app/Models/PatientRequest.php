<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientRequest extends Model
{
    protected $fillable = [
        'patient_name',
        'service_type',
        'request_date',
        'phone',
        'pickup_address',
        'destination',
        'patient_condition',
        'status',
        'dispatch_id',
    ];

    protected $casts = [
        'request_date' => 'date',
    ];

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class);
    }
}
