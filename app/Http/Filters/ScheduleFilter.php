<?php

namespace App\Http\Filters;

class ScheduleFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'customer_id',
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
     * Filter the query by a given customer_id.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function customer_id($value)
    {
        if ($value) {
            return $this->builder->whereHas('customer_id', function ($query) use ($value) {
                return $query->where('id', $value);
            });
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
