<?php

namespace App\Models\Helpers;

use App\Models\Schedule;

trait ScheduleHelpers
{
    /**
     * Determine whether the task is completed.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->status === Schedule::COMPLETED_STATUS;
    }

    /**
     * Determine whether the task is ongoing.
     *
     * @return bool
     */
    public function isOngoing()
    {
        return $this->status === Schedule::ONGOING_STATUS;
    }
}
