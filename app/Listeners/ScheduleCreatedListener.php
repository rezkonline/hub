<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\ScheduleCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduleCreatedNotifications;

class ScheduleCreatedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ScheduleCreatedEvent  $event
     * @return void
     */
    public function handle(ScheduleCreatedEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new ScheduleCreatedNotifications($event->schedule));
        });

        // Send notification to schedule's manager
        Notification::send($event->schedule->customer->manager, new ScheduleCreatedNotifications($event->schedule));

        // Send notification to schedule's employee
        $event->schedule->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new ScheduleCreatedNotifications($event->schedule));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to schedule's customer
            Notification::send($event->schedule->customer, new ScheduleCreatedNotifications($event->schedule));
        }
    }
}
