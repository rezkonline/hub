<?php

namespace App\Notifications;

use App\Http\Resources\ActivityResource;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CampaignCreatedNotifications extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $campaign;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($campaign)
    {
        $this->campaign = $campaign;
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
        $url = route('dashboard.campaigns.show', $this->campaign);

        return (new MailMessage())->view(
            'emails.create', ['collection' => $this->campaign->activities()->first(), 'url' => $url]
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
            'campaign_id' => $this->campaign->id,
            'user_id' => ! is_null(app('impersonate')->getImpersonatorId()) ? app('impersonate')->getImpersonatorId() : $this->campaign->customer_id,
            'body' => 'notifications.campaigns.body',
            'localed_data' => ['title' => $this->campaign->name],
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
        $user = (! is_null(app('impersonate')->getImpersonatorId()) ? app('impersonate')->getImpersonatorId() : $this->campaign->customer_id);
        $user = User::find($user);

        return new BroadcastMessage([
            'campaign_id' => $this->campaign->id,
            'body' => trans('notifications.campaigns.body', ['user' => $user->name, 'title' => $this->campaign->name]),
            'view' => [
                'type' => 'campaign',
                'id' => $this->campaign->id,
                'url' => route('dashboard.campaigns.show', $this->campaign),
            ],
        ]);
    }
}
