<?php

namespace App\Models\Scopes;

use App\Models\Message;
use App\Models\Transaction;

trait TransactionScopes
{
    /**
     * Get transactions.
     *
     * @param $query
     * @return mixed
     */
    public function scopePackages($query)
    {
        return $query->where('type', Transaction::PACKAGE_TYPE);
    }
}
