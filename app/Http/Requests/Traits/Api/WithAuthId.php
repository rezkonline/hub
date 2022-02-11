<?php

namespace App\Http\Requests\Traits\Api;

trait WithAuthId
{
    /**
     * Return request inputs with customer id.
     *
     * @param string $var
     * @return array
     */
    public function allWithAuthId($var = 'customer_id')
    {
        if (auth()->user()) {
            return array_merge([
                $var => auth()->user()->id,
            ], $this->all());
        }

        return $this->all();
    }

    /**
     * Return request inputs with customer id or impersonator id.
     *
     * @param string $var
     * @return array
     */
    public function allWithImpersonatorOrAuthId($var = 'customer_id')
    {
        $data = [];

        if ($id = app('impersonate')->getImpersonatorId()) {
            $data[$var] = $id;
        } elseif (auth()->user()) {
            $data[$var] = auth()->user()->id;
        }

        return array_merge($data, $this->all());
    }
}
