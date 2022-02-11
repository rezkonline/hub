<?php

namespace App\Models\Relations;

use App\Models\Customer;
use App\Models\User;

trait EmployeeRelations
{
    /**
     * Get customers.
     *
     * @return mixed
     */
    public function customers()
    {
        return $this->belongsToMany(User::class, 'employee_customer', 'employee_id', 'customer_id');
    }
}
