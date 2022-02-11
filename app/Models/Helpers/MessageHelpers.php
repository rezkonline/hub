<?php

namespace App\Models\Helpers;

trait MessageHelpers
{
    /**
     * Check if the message seen by customer.
     *
     * @return boolean
     */
    public function isSeenByCustomer()
    {
        return $this->seen_by_customer;
    }

    /**
     * Check if the message seen by manager.
     *
     * @return boolean
     */
    public function isSeenByManager()
    {
        return $this->seen_by_manager;
    }
}
