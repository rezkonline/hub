<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any message.
     *
     * @param \App\Models\User $user
     * @param User $model
     * @return mixed
     */
    public function viewAny(User $user, User $model)
    {
        return $model->isCustomer() && ($user->isAdmin() || ($user->isSupervisor() && $model->manager->is($user)));
    }

    /**
     * Determine whether the user can create message.
     *
     * @param \App\Models\User $user
     * @param User $model
     * @return mixed
     */
    public function create(User $user, User $model)
    {
        return $model->isCustomer() && ($user->isAdmin() || ($user->isSupervisor() && $model->manager->is($user)));
    }
}
