<?php

namespace App\Notifications;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private Meeting $meeting
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())->view(
            'emails.meeting',
            [
                'notifiable' => $notifiable,
                'body' => $this->meeting->description,
                'name' => $this->meeting->name,
            ],
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'meeting_id' => $this->meeting->id,
            'user_id' => $notifiable->user_id,
            'body' => 'notifications.meeting.body',
            'localed_data' => [
                'name' => $this->meeting->name,
                'start_at' => $this->meeting->start_at->format('Y-m-d H:i'),
            ],
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'body' => trans('notifications.meeting.body', [
                'name' => $this->meeting->name,
                'start_at' => $this->meeting->start_at->format('Y-m-d H:i'),
            ]),
            'view' => [
                'type' => 'meeting',
                'id' => $this->meeting->id,
                'url' => route('dashboard.meetings.show', $this->meeting),
            ],
        ]);
    }
}
