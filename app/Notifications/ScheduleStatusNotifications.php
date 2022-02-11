<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ScheduleStatusNotifications extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $schedule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

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
        $url = route('dashboard.schedules.show', $this->schedule);

        return (new MailMessage())->view(
            'emails.update', ['collection' => $this->schedule->activities()->first(), 'status' => $this->schedule->status, 'url' => $url]
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
            'schedule_id' => $this->schedule->id,
            'user_id' => ! is_null(app('impersonate')->getImpersonatorId()) ? app('impersonate')->getImpersonatorId() : $this->schedule->customer_id,
            'body' => 'notifications.schedules.status.'.$this->schedule->status,
            'localed_data' => ['title' => $this->schedule->name],
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
            'schedule_id' => $this->schedule->id,
            'body' => trans('notifications.schedules.status.'.$this->schedule->status, ['title' => $this->schedule->name]),
            'view' => [
                'type' => 'schedule',
                'id' => $this->schedule->id,
                'url' => route('dashboard.schedules.show', $this->schedule),
            ],
        ]);
    }
}
