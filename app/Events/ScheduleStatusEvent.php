<?php

namespace App\Events;

use App\Models\Schedule;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ScheduleStatusEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Schedule
     */
    public $schedule;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Schedule  $schedule
     */
    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }
}
