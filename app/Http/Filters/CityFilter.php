<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CityFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'country',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->whereTranslationLike('name', "%$value%");
        }

        return $this->builder;
    }

    protected function country($value)
    {
        if ($value) {
            return $this->builder->whereHas('country', function (Builder $query) use ($value) {
                $query->whereTranslationLike('name', "%$value%")->orWhere('id', $value);
            });
        }
    }
}
