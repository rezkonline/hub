<?php

namespace App\Models\Helpers;

use App\Models\Task;

trait TaskHelpers
{
    /**
     * Determine whether the task is completed.
     *
     * @return bool
     */
    public function isCompleted()
    {
        return $this->status === Task::COMPLETED_STATUS;
    }

    /**
     * Determine whether the task is ongoing.
     *
     * @return bool
     */
    public function isOngoing()
    {
        return $this->status === Task::ONGOING_STATUS;
    }
}
