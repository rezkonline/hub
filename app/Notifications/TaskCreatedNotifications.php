<?php

namespace App\Notifications;

use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TaskCreatedNotifications extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
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
        $url = route('dashboard.tasks.show', $this->task);

        return (new MailMessage())->view(
            'emails.create', ['collection' => $this->task->activities()->first(), 'url' => $url]
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
            'task_id' => $this->task->id,
            'user_id' => ! is_null(app('impersonate')->getImpersonatorId()) ? app('impersonate')->getImpersonatorId() : $this->task->customer_id,
            'body' => 'notifications.tasks.body',
            'localed_data' => ['title' => $this->task->name],
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
        $user = (! is_null(app('impersonate')->getImpersonatorId()) ? app('impersonate')->getImpersonatorId() : $this->task->customer_id);
        $user = User::find($user);

        return new BroadcastMessage([
            'task_id' => $this->task->id,
            'body' => trans('notifications.tasks.body', ['user' => $user->name, 'title' => $this->task->name]),
            'view' => [
                'type' => 'task',
                'id' => $this->task->id,
                'url' => route('dashboard.tasks.show', $this->task),
            ],
        ]);
    }
}
