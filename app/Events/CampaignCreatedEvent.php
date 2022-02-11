<?php

namespace App\Events;

use App\Models\Campaign;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CampaignCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Campaign
     */
    public $campaign;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Campaign  $campaign
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }
}
