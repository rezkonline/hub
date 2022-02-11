<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any packages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the packages.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $packages
     * @return mixed
     */
    public function view(User $user, Package $packages)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can create packages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the packages.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $packages
     * @return mixed
     */
    public function update(User $user, Package $packages)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the packages.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $packages
     * @return mixed
     */
    public function delete(User $user, Package $packages)
    {
        return $user->isSupervisor() || $user->isAdmin();
    }
}
