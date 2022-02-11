<?php

namespace App\Models\Scopes;

trait CityScopes
{
    /**
     * Get cities with the given country id.
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeCountry($query, $id)
    {
        return $query->where('country_id', $id);
    }
}
