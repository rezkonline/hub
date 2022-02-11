<?php

namespace App\Http\Resources;

use App\Notifications\TaskStatusNotifications;
use App\Notifications\MessageSentNotifications;
use App\Notifications\TaskCreatedNotifications;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Notifications\CampaignStatusNotifications;
use App\Notifications\ScheduleStatusNotifications;
use App\Notifications\CampaignCreatedNotifications;
use App\Notifications\ScheduleCreatedNotifications;

/** @mixin \App\Models\Notification */
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->getBody(),
            'created_at' => $this->created_at->diffForHumans(),
            'is_read' => ! ! $this->read_at,
            'view' => $this->getView(),
        ];
    }

    /**
     * Get the notification view type and id.
     *
     * @return array
     */
    private function getView()
    {
        $view = [
            'type' => 'custom',
            'id' => null,
            'dashboard_url' => route('dashboard.home'),
        ];
        switch ($this->type) {
            case TaskCreatedNotifications::class:
                $view = [
                    'type' => 'task',
                    'id' => $this->task_id,
                    'url' => route('dashboard.tasks.show', $this->task),
                ];
                break;
            case CampaignCreatedNotifications::class:
                $view = [
                    'type' => 'campaign',
                    'id' => $this->campaign_id,
                    'url' => route('dashboard.campaigns.show', $this->campaign),
                ];
                break;
            case ScheduleCreatedNotifications::class:
                $view = [
                    'type' => 'schedule',
                    'id' => $this->schedule_id,
                    'url' => route('dashboard.schedules.show', $this->schedule_id),
                ];
                break;
            case MessageSentNotifications::class:
                $view = [
                    'type' => 'chat',
                    'id' => '',
                    'url' => route('dashboard.users.messages.index', $this->user_id),
                ];
                break;
        }

        return $view;
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    private function getBody()
    {
        if ($this->type == TaskStatusNotifications::class) {
            return trans('notifications.tasks.status.'.$this->task->status);
        }

        if ($this->type == CampaignStatusNotifications::class) {
            return trans('notifications.campaigns.status.'.$this->campaign->status);
        }

        if ($this->type == ScheduleStatusNotifications::class) {
            return trans('notifications.schedules.status.'.$this->schedule->status);
        }

        return trans($this->data['body'], array_merge([
            'user' => $this->user->name,
        ], isset($this->data['localed_data']) ? $this->data['localed_data'] : []));
    }
}
