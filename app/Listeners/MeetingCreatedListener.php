<?php

namespace App\Listeners;

use App\Events\MeetingCreatedEvent;
use App\Models\Supervisor;
use App\Notifications\MeetingCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MeetingCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\MeetingCreatedEvent  $event
     * @return void
     */
    public function handle(MeetingCreatedEvent $event)
    {
        try {
            $event->meeting->customers->each(
                fn ($customer) => $customer->notify(new MeetingCreatedNotification($event->meeting))
            );

            Supervisor::chunk(10, function ($supervisors) use ($event) {
                foreach ($supervisors as $supervisor) {
                    $supervisor->notify(new MeetingCreatedNotification($event->meeting));
                }
            });
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
