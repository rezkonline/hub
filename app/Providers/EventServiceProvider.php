<?php

namespace App\Providers;

use App\Events\TaskStatusEvent;
use App\Events\MessageSentEvent;
use App\Events\TaskCreatedEvent;
use App\Events\CampaignStatusEvent;
use App\Events\ScheduleStatusEvent;
use App\Events\CampaignCreatedEvent;
use App\Events\ScheduleCreatedEvent;
use App\Listeners\TaskStatusListener;
use App\Listeners\MessageSentListener;
use App\Listeners\TaskCreatedListener;
use Illuminate\Auth\Events\Registered;
use App\Listeners\CampaignStatusListener;
use App\Listeners\ScheduleStatusListener;
use App\Listeners\CampaignCreatedListener;
use App\Listeners\ScheduleCreatedListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TaskCreatedEvent::class => [
            TaskCreatedListener::class,
        ],
        TaskStatusEvent::class => [
            TaskStatusListener::class,
        ],
        CampaignCreatedEvent::class => [
            CampaignCreatedListener::class,
        ],
        CampaignStatusEvent::class => [
            CampaignStatusListener::class,
        ],
        ScheduleCreatedEvent::class => [
            ScheduleCreatedListener::class,
        ],
        ScheduleStatusEvent::class => [
            ScheduleStatusListener::class,
        ],
        MessageSentEvent::class => [
            MessageSentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
