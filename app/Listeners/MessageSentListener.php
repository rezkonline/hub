<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MessageSentNotifications;

class MessageSentListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (auth()->user()->isCustomer() && ! app('impersonate')->getImpersonatorId()) {
            Notification::send($event->message->manager, new MessageSentNotifications($event->message));
        } else {
            Notification::send($event->message->customer, new MessageSentNotifications($event->message));
        }
    }
}
