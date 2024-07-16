<?php

namespace App\Models\Helpers;

use App\Models\User;

trait MeetingHelpers
{
    /**
     * Determine whether the meeting is started.
     *
     * @return bool
     */
    public function isStarted()
    {
        return $this->start_at->lte(now());
    }

    /**
     * Determine whether the meeting is finished.
     *
     * @return bool
     */
    public function isFinished()
    {
        return $this->start_at->addMinutes($this->duration)->lte(now());
    }

    /**
     * Determine whether user can join meeting.
     *
     * @return bool
     */
    public function hasInvitation(User $user)
    {
        return $user->isSupervisor() || $user->isAdmin() || $this->customers()->where('user_id', $user->getKey())->exists();
    }
}
