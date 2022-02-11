<?php

namespace App\Http\Requests\Traits;

trait WithCustomerId
{
    /**
     * Return request inputs with customer id.
     *
     * @since 1.0.0
     * @return array
     */
    public function allWithCustomerId()
    {
        if ($this->route('user')) {
            return array_merge([
                'customer_id' => $this->route('user')->id,
            ], $this->all());
        }

        return $this->all();
    }
}
