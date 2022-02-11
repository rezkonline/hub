<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AchievementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create packages.
     *
     * @param \App\Models\User $user
     * @param User $model
     * @return mixed
     */
    public function create(User $user, User $model)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $model->manager->is($user)) || ($user->isEmployee() && $model->employees->contains($user));
    }

    /**
     * Determine whether the user can update the packages.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $achievement
     * @return mixed
     */
    public function update(User $user, Achievement $achievement)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $achievement->customer->manager->is($user)) || ($user->isEmployee() && $achievement->customer->employees->contains($user));
    }

    /**
     * Determine whether the user can delete the packages.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Achievement  $achievement
     * @return mixed
     */
    public function delete(User $user, Achievement $achievement)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $achievement->customer->manager->is($user)) || ($user->isEmployee() && $achievement->customer->employees->contains($user));
    }
}
