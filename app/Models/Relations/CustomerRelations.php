<?php

namespace App\Models\Relations;

use App\Models\Task;
use App\Models\Message;
use App\Models\Package;
use App\Models\Campaign;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Supervisor;
use App\Models\Achievement;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CustomerRelations
{
    /**
     * Get user's manager.
     *
     * @return HasOne
     */
    public function manager()
    {
        return $this->hasOne(Supervisor::class, 'id', 'manager_id');
    }

    /**
     * Get user's employees.
     *
     * @return BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_customer', 'customer_id', 'employee_id');
    }

    /**
     * Get packages assigned to this customer.
     *
     * @return BelongsToMany
     */
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    /**
     * Get transactions assigned to this customer.
     *
     * @return HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    /**
     * Return all tasks.
     *
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'customer_id');
    }

    /**
     * Return all schedules.
     *
     * @return HasMany
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'customer_id');
    }

    /**
     * Return all ad campaigns.
     *
     * @return HasMany
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'customer_id');
    }

    /**
     * Return all messages.
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'customer_id');
    }

    /**
     * Return all achievements.
     *
     * @return HasMany
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class, 'customer_id');
    }
}
