<?php

namespace App\Models\Relations;

use App\Models\Customer;

trait MeetingRelations
{
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
