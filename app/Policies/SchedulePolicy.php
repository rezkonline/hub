<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any schedules.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isEmployee() || $user->isSupervisor() || $user->isCustomer();
    }

    /**
     * Determine whether the user can view the schedule.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Schedule  $schedule
     * @return mixed
     */
    public function view(User $user, Schedule $schedule)
    {
        return ($user->isAdmin() || ($user->isEmployee() && $schedule->customer->employees->contains($user)) || ($user->isSupervisor() && $schedule->customer->manager->is($user)) || ($user->isCustomer() && $schedule->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user can create schedules.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isCustomer();
    }

    /**
     * Determine whether the user can update the schedule.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Schedule  $schedule
     * @return mixed
     */
    public function update(User $user, Schedule $schedule)
    {
        return ($user->isAdmin() || ($user->isSupervisor() && $schedule->customer->manager->is($user)) || ($user->isCustomer() && $schedule->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user add comment to the schedule.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Schedule  $schedule
     * @return mixed
     */
    public function comment(User $user, Schedule $schedule)
    {
        return $this->view();
    }

    /**
     * Determine whether the user can delete the schedule.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Schedule  $schedule
     * @return mixed
     */
    public function delete(User $user, Schedule $schedule)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $schedule->customer->manager->is($user));
    }
}
