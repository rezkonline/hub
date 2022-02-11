<?php

namespace App\Models\Relations;

use App\Models\City;

trait CountryRelations
{
    /**
     * Get all the country cities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
