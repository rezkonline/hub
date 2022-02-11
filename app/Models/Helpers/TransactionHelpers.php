<?php

namespace App\Models\Helpers;

trait TransactionHelpers
{
    /**
     * The transaction receipt file url.
     *
     * @return bool
     */
    public function getReceipt()
    {
        return $this->getFirstMediaUrl('receipt');
    }
}
