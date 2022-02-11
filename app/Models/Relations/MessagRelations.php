<?php

namespace App\Models\Relations;

use App\Models\User;
use App\Models\Customer;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MessagRelations
{
    /**
     * Get customer.
     *
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get manager.
     *
     * @return BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(Supervisor::class, 'manager_id');
    }

    /**
     * Get sender.
     *
     * @return BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
