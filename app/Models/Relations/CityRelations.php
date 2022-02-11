<?php

namespace App\Models\Relations;

use App\Models\Country;

trait CityRelations
{
    /**
     * Get the country of the city.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
