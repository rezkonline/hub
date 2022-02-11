<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'dates',
    ];

    /**
     * Filter the query by the given date.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function dates($value)
    {
        if ($value) {
            return $this->builder->whereBetween('created_at', explode(',', $value));
        }

        return $this->builder;
    }
}
