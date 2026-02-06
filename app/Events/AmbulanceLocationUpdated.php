<?php

namespace App\Events;

use App\Models\Ambulance;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AmbulanceLocationUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public function __construct(public Ambulance $ambulance) {}

    public function broadcastOn(): Channel
    {
        return new Channel('ambulance-gps');
    }

    public function broadcastAs(): string
    {
        return 'gps.updated';
    }
}
