<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\TaskCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskCreatedNotifications;

class TaskCreatedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TaskCreatedEvent  $event
     * @return void
     */
    public function handle(TaskCreatedEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new TaskCreatedNotifications($event->task));
        });

        // Send notification to task's manager
        Notification::send($event->task->customer->manager, new TaskCreatedNotifications($event->task));

        // Send notification to task's employee
        $event->task->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new TaskCreatedNotifications($event->task));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to task's customer
            Notification::send($event->task->customer, new TaskCreatedNotifications($event->task));
        }
    }
}
