<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class MessageSentNotifications extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
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
        $url = '#';
        if ($this->message->sender->isCustomer()) {
            $url = route('dashboard.users.messages.index', $this->message->sender);
        }

        return (new MailMessage())->view(
            'emails.message', ['collection' => $this->message, 'url' => $url]
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
            'user_id' => $this->message->sender->id,
            'body' => 'notifications.messages.body',
            'localed_data' => [],
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
            'body' => trans('notifications.messages.body', ['user' => $this->message->sender->name]),
            'view' => [
                'type' => 'chat',
                'id' => '',
                'url' => route('dashboard.users.messages.index', $this->message->customer),
            ],
        ]);
    }
}
