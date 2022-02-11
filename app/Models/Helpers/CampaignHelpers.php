<?php

namespace App\Models\Helpers;

use App\Models\Campaign;

trait CampaignHelpers
{
    /**
     * Determine whether the task is completed.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->status === Campaign::COMPLETED_STATUS;
    }

    /**
     * Determine whether the task is ongoing.
     *
     * @return bool
     */
    public function isOngoing()
    {
        return $this->status === Campaign::ONGOING_STATUS;
    }
}
