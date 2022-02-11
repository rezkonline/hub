<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\TaskStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskStatusNotifications;

class TaskStatusListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TaskStatusEvent  $event
     * @return void
     */
    public function handle(TaskStatusEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new TaskStatusNotifications($event->task));
        });

        // Send notification to task's manager
        Notification::send($event->task->customer->manager, new TaskStatusNotifications($event->task));

        // Send notification to task's employee
        $event->task->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new TaskStatusNotifications($event->task));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to task's customer
            Notification::send($event->task->customer, new TaskStatusNotifications($event->task));
        }
    }
}
