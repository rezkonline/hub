<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @param string $resource
     * @return mixed
     */
    public function viewAny(User $user, string $resource = '')
    {
        if (empty($resource)) {
            $resource = request()->query('type', User::CUSTOMER_TYPE);
        }
        return $user->isAdmin() || (($user->isSupervisor() || $user->isEmployee()) && $resource === User::CUSTOMER_TYPE);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return ($user->isAdmin() || $user->is($model))
            || ($user->isSupervisor() && $user->is($model->manager))
            || ($user->isEmployee() && $model->employees->contains($user));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $this->view($user, $model);
    }

    /**
     * Determine whether the user can update the type of the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function updateType(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }

    /**
     * Determine whether the user can attach packages to this model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function attachPackage(User $user, User $model)
    {
        return $this->view($user, $model);
    }

    /**
     * Determine whether the user can detach package from this model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function detachPackage(User $user, User $model)
    {
        return $this->view($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }

    /**
     * Determine whether the user can activate the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function activate(User $user, User $model)
    {
        return $user->isAdmin() && $model->isCustomer() && ! $model->isActivated();
    }

    /**
     * Determine whether the user can deactivate the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function deactivate(User $user, User $model)
    {
        return $user->isAdmin() && $model->isCustomer() && $model->isActivated();
    }

    /**
     * Determine whether the user can store attachment for the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function storeAttachment(User $user, User $model)
    {
        return $user->isAdmin() && $model->isCustomer();
    }

    /**
     * Determine whether the user can destroy attachment for the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return mixed
     */
    public function destroyAttachment(User $user, User $model)
    {
        return $user->isAdmin() && $model->isCustomer();
    }
}
