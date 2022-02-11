<?php

namespace App\Models\Relations;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TransactionRelations
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

    /**
     * Return who added this transaction.
     *
     * @return BelongsTo
     */
    public function actor()
    {
        return $this->belongsTo(User::class);
    }
}
