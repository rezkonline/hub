<?php

namespace App\Models\Observers;

use App\Models\Notification;

class NotificationObserver
{
    /**
     * @param Notification $notification
     */
    public function creating(Notification $notification)
    {
        if ((!empty($notification->task_id) || !empty($notification->campaign_id) || !empty($notification->schedule_id)) && $notification->user_id) {
            return;
        }

        $data = $notification->data;

        if (isset($data['task_id'])) {
            $notification->task_id = $data['task_id'];
        } elseif (isset($data['campaign_id'])) {
            $notification->campaign_id = $data['campaign_id'];
        } elseif (isset($data['schedule_id'])) {
            $notification->schedule_id = $data['schedule_id'];
        }

        $notification->user_id = $data['user_id'];
    }
}
