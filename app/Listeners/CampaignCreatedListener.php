<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Events\CampaignCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CampaignCreatedNotifications;

class CampaignCreatedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CampaignCreatedEvent  $event
     * @return void
     */
    public function handle(CampaignCreatedEvent $event)
    {
        // Send notification to all admins.
        Admin::each(function (User $user) use ($event) {
            Notification::send($user, new CampaignCreatedNotifications($event->campaign));
        });

        // Send notification to campaign's manager
        Notification::send($event->campaign->customer->manager, new CampaignCreatedNotifications($event->campaign));

        // Send notification to campaign's employee
        $event->campaign->customer->employees->each(function ($employee) use ($event) {
            Notification::send($employee, new CampaignCreatedNotifications($event->campaign));
        });

        if (app('impersonate')->getImpersonatorId()) {
            // Send notification to campaign's customer
            Notification::send($event->campaign->customer, new CampaignCreatedNotifications($event->campaign));
        }
    }
}
