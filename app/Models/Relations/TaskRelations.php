<?php

namespace App\Models\Relations;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TaskRelations
{
    /**
     * Return customer.
     *
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
