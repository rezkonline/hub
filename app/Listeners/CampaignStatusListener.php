<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\CampaignStatusEvent;
use App\Notifications\TaskCreatedNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CampaignStatusNotifications;

class CampaignStatusListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CampaignStatusEvent  $event
     * @return void
     */
    public function handle(CampaignStatusEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new CampaignStatusNotifications($event->campaign));
        });

        // Send notification to campaign's manager
        Notification::send($event->campaign->customer->manager, new CampaignStatusNotifications($event->campaign));

        // Send notification to campaign's employee
        $event->campaign->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new CampaignStatusNotifications($event->campaign));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to campaign's customer
            Notification::send($event->campaign->customer, new CampaignStatusNotifications($event->campaign));
        }
    }
}
