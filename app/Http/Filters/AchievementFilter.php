<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class AchievementFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'title',
        'value',
        'customer',
    ];

    /**
     * Filter the query by a given title.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function title($value)
    {
        if ($value) {
            return $this->builder->where('title', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given value.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function value($value)
    {
        if ($value) {
            return $this->builder->where('value', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given customer.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function customer($value)
    {
        if ($value) {
            return $this->builder->whereHas('customer', function (Builder $query) use ($value) {
                $query->where('id', $value);
            });
        }

        return $this->builder;
    }
}
