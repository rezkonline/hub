<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isSupervisor() || $user->isEmployee() || $user->isCustomer();
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return $user->isAdmin() || ($user->isEmployee() && $task->customer->employees->contains($user)) || ($user->isSupervisor() && $task->customer->manager->is($user)) || ($user->isCustomer() && $task->customer->is($user));
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isCustomer();
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return ($user->isAdmin() || ($user->isSupervisor() && $task->customer->manager->is($user)) || ($user->isCustomer() && $task->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user add comment to the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function comment(User $user, Task $task)
    {
        return ($user->isAdmin() || ($user->isEmployee() && $task->customer->employees->contains($user)) || ($user->isSupervisor() && $task->customer->manager->is($user)) || ($user->isCustomer() && $task->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $task->customer->manager->is($user));
    }
}
