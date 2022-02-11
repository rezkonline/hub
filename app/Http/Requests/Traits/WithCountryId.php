<?php

namespace App\Http\Requests\Traits;

trait WithCountryId
{
    /**
     * Return request inputs with country id.
     *
     * @since 1.0.0
     */
    public function allWithCountryId()
    {
        if ($this->route('country')) {
            return array_merge([
                'country_id' => $this->route('country')->id,
            ], $this->all());
        }

        return $this->all();
    }
}
