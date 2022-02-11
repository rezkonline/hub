<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any campaigns.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isEmployee() || $user->isSupervisor() || $user->isCustomer();
    }

    /**
     * Determine whether the user can view the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return mixed
     */
    public function view(User $user, Campaign $campaign)
    {
        return ($user->isAdmin() || ($user->isEmployee() && $campaign->customer->employees->contains($user)) || ($user->isSupervisor() && $campaign->customer->manager->is($user)) || ($user->isCustomer() && $campaign->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user can create campaigns.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isCustomer();
    }

    /**
     * Determine whether the user can update the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return mixed
     */
    public function update(User $user, Campaign $campaign)
    {
        return ($user->isAdmin() || ($user->isSupervisor() && $campaign->customer->manager->is($user)) || ($user->isCustomer() && $campaign->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user add comment to the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return mixed
     */
    public function comment(User $user, Campaign $campaign)
    {
        return ($user->isAdmin() || ($user->isEmployee() && $campaign->customer->employees->contains($user)) || ($user->isSupervisor() && $campaign->customer->manager->is($user)) || ($user->isCustomer() && $campaign->customer->is($user))) ? true : false;
    }

    /**
     * Determine whether the user can delete the campaign.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Campaign  $campaign
     * @return mixed
     */
    public function delete(User $user, Campaign $campaign)
    {
        return $user->isAdmin() || ($user->isSupervisor() && $campaign->customer->manager->is($user));
    }
}
