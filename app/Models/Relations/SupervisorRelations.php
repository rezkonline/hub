<?php

namespace App\Models\Relations;

use App\Models\Customer;

trait SupervisorRelations
{
    /**
     * Get customers.
     *
     * @return mixed
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'manager_id');
    }
}
