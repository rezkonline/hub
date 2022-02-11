<?php

namespace App\Models\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

trait UserHelpers
{
    /**
     * Determine whether the user is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type == User::ADMIN_TYPE;
    }

    /**
     * Determine whether the user is supervisor.
     *
     * @return bool
     */
    public function isSupervisor()
    {
        return $this->type == User::SUPERVISOR_TYPE;
    }

    /**
     * Determine whether the user is employee.
     *
     * @return bool
     */
    public function isEmployee()
    {
        return $this->type == User::EMPLOYEE_TYPE;
    }

    /**
     * Determine whether the user is customer.
     *
     * @return bool
     */
    public function isCustomer()
    {
        return $this->type == User::CUSTOMER_TYPE;
    }

    /**
     * Set the user type.
     *
     * @return $this
     */
    public function setType($type)
    {
        if (Gate::allows('updateType', $this)
            && in_array($type, array_keys(trans('users.types')))) {
            $this->forceFill([
                'type' => $type,
            ])->save();
        }

        return $this;
    }

    /**
     * Determine whether the user can access dashboard.
     *
     * @return bool
     */
    public function canAccessDashboard()
    {
        return $this->isAdmin() || $this->isSupervisor() || $this->isEmployee();
    }

    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl('avatar');
    }

    /**
     * The user strategic plan file url.
     *
     * @return bool
     */
    public function getStrategicPlan()
    {
        return $this->getFirstMediaUrl('strategy');
    }

    /**
     * The user wallet total.
     *
     * @return int
     */
    public function getWallet()
    {
        $total = 0;

        if (! $this->isCustomer()) {
            return $total;
        }

        $this->transactions->each(function ($transaction) use (&$total) {
            $total += $transaction->amount;
        });

        return $total;
    }

    /**
     * The user payed transactions.
     *
     * @return int
     */
    public function getPayedTransactions()
    {
        $total = 0;

        if (! $this->isCustomer()) {
            return $total;
        }

        $this->transactions->each(function ($transaction) use (&$total) {
            if ($transaction->amount > 0) {
                $total += $transaction->amount;
            }
        });

        return $total;
    }

    /**
     * The user remaining transactions.
     *
     * @return int
     */
    public function getRemainingTransactions()
    {
        $total = 0;

        if (! $this->isCustomer()) {
            return $total;
        }

        $this->transactions->each(function ($transaction) use (&$total) {
            if ($transaction->amount < 0) {
                $total += $transaction->amount;
            }
        });

        return - $total;
    }

    /**
     * Get count of packages.
     *
     * @return int
     */
    public function getPurchases()
    {
        if ($this->packages) {
            return $this->packages->count();
        }

        return 0;
    }

    /**
     * Get impersonator id instance.
     *
     * @return User
     */
    public function getImpersonatorInstance()
    {
        return User::find(app('impersonate')->getImpersonatorId());
    }

    /**
     * @return array
     */
    public function getCurrentSettings()
    {
        $settings = [];
        $keys = $this->getSettingFields();

        foreach ($keys as $key) {
            $settings[$key] = $this->getSetting($key);
        }

        return $settings;
    }

    /**
     * @return bool
     */
    public function removeSettings()
    {
        $keys = $this->getSettingFields();
        
        foreach ($keys as $key) {
            $this->setSetting($key, false);
        }
        $this->save();

        return true;
    }

    /**
     * @return array
     */
    public function getActiveSettings()
    {
        $settings = [];
        $keys = $this->getSettingFields();

        foreach ($keys as $key) {
            if ($this->getSetting($key)) {
                $settings[] = $key;
            }
        }

        return $settings;
    }
}
