<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\ScheduleStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduleStatusNotifications;

class ScheduleStatusListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ScheduleStatusEvent  $event
     * @return void
     */
    public function handle(ScheduleStatusEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new ScheduleStatusNotifications($event->schedule));
        });

        // Send notification to schedule's manager
        Notification::send($event->schedule->customer->manager, new ScheduleStatusNotifications($event->schedule));

        // Send notification to schedule's employee
        $event->schedule->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new ScheduleStatusNotifications($event->task));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to schedule's customer
            Notification::send($event->schedule->customer, new ScheduleStatusNotifications($event->schedule));
        }
    }
}
