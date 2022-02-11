<?php

namespace App\Http\Filters\Api;

use App\Http\Filters\BaseFilters;

class MessageFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'customer',
        'manager',
        'sender',
    ];

    /**
     * Filter the query by a given customer id.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function customer($value)
    {
        if ($value) {
            return $this->builder->where('customer_id', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given manager id.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function manager($value)
    {
        if ($value) {
            return $this->builder->where('manager_id', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given sender id.
     *
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sender($value)
    {
        if ($value) {
            return $this->builder->where('sender_id', $value);
        }

        return $this->builder;
    }
}
