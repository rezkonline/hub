<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilters;

class CampaignFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'budget',
        'target',
        'status',
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
     * Filter the query by a given target.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function target($value)
    {
        if ($value) {
            return $this->builder->where('target', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given budget.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function budget($value)
    {
        if ($value) {
            return $this->builder->where('budget', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given name.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($value)
    {
        if ($value) {
            return $this->builder->where('status', $value);
        }

        return $this->builder;
    }
}
