<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any meetings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the meetings.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meeting  $meetings
     * @return mixed
     */
    public function view(User $user, Meeting $meetings)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can create meetings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the meetings.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meeting  $meetings
     * @return mixed
     */
    public function update(User $user, Meeting $meetings)
    {
        return ($user->isSupervisor() || $user->isAdmin()) && !$meetings->isStarted();
    }

    /**
     * Determine whether the user can delete the meetings.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meeting  $meetings
     * @return mixed
     */
    public function delete(User $user, Meeting $meetings)
    {
        return $user->isAdmin() && !$meetings->isStarted();
    }
}
