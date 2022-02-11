<?php

namespace App\Models\Relations;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CampaignRelations
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
