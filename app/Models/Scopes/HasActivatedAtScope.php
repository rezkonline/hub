<?php

namespace App\Models\Scopes;

trait HasActivatedAtScope
{
    /**
     * Get models with activation.
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithActivation($query)
    {
        return $query->whereNotNull('activated_at');
    }

    /**
     * Get models without activation.
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithoutActivation($query)
    {
        return $query->whereNull('activated_at');
    }
}
