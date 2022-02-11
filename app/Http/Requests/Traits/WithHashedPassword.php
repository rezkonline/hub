<?php

namespace App\Http\Requests\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait WithHashedPassword
{
    /**
     * Get all of the input and files for the request and hash password if exists.
     *
     * @return array
     */
    public function allWithHashedPassword()
    {
        if ($this->input('type') !== User::CUSTOMER_TYPE) {
            $data = $this->except(array_keys($this->customerRules()));
        } else {
            $data = $this->all();
        }

        if ($password = $this->input('password')) {
            $data = array_merge(
                $data,
                ['password' => Hash::make($password)]
            );
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        return $data;
    }
}
