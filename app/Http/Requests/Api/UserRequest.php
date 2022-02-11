<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email,'.auth()->id()],
            'avatar' => ['nullable', 'image'],
            'old_password' => ['nullable', 'string', 'min:8'],
            'password' => ['nullable', 'required_with:old_password', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required_with_all:old_password,password'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('customers.attributes');
    }
}
