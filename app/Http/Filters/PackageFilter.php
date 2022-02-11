<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class PackageFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'price',
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
            return $this->builder->where('name', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given price.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function price($value)
    {
        if ($value) {
            return $this->builder->where('price', $value);
        }

        return $this->builder;
    }
}
