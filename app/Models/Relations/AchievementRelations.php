<?php

namespace App\Models\Relations;

use App\Models\Customer;

trait AchievementRelations
{
    /**
     * Get customer.
     *
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
