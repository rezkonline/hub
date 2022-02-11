<?php

namespace App\Http\Filters;

class UserFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'type',
        'email',
        'country',
        'city',
        'status',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->where('name', 'like', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query to include users by type.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function type($value)
    {
        if ($value) {
            return $this->builder->where('type', $value);
        }

        return $this->builder;
    }

    /**
     * Default filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function defaultType()
    {
        return $this->builder->where('type', 'customer');
    }

    /**
     * Filter the query to include users by email.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function email($value)
    {
        if ($value) {
            return $this->builder->where('email', 'like', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query to include users by given country id.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function country($value)
    {
        return $this->builder->where('country_id', $value);
    }

    /**
     * Filter the query to include users by given city id.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function city($value)
    {
        return $this->builder->where('city_id', $value);
    }

    /**
     * Filter the query to include users by given status.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($value)
    {
        if ($value === 'deactivated') {
            return $this->builder->whereNull('activated_at');
        }

        return $this->builder->whereNotNull('activated_at');
    }
}
