<?php

namespace App\Models\Observers;

use App\Models\Customer;

class CustomerObserver
{
    /**
     * @param Customer $customer
     */
    public function created(Customer $customer)
    {
        $customer->activate();
    }
}
