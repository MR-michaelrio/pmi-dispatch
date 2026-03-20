<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DispatchLocationHistory extends Model
{
    protected $fillable = [
        'dispatch_id',
        'latitude',
        'longitude',
    ];

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }
}
