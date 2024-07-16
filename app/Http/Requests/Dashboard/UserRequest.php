<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\WithHashedPassword;

class UserRequest extends FormRequest
{
    use WithHashedPassword;

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
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function createRules()
    {
        return array_merge([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('users.types')))],
        ], $this->customerRules());
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    public function updateRules()
    {
        return array_merge([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$this->route('user')->id],
            'phone' => ['required', 'unique:users,phone,'.$this->route('user')->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('users.types')))],
        ], $this->customerRules());
    }

    /**
     * Get the customer type validation rules that apply to the request.
     *
     * @return array
     */
    public function customerRules()
    {
        $resource = Str::plural(request()->query('type', User::CUSTOMER_TYPE));
        if (is_object($this->route('user')) && isset($this->route('user')->id)) {
            $resource = Str::plural($this->route('user')->type);
        }

        if ($resource !== Str::plural(User::CUSTOMER_TYPE)) {
            return [];
        }

        return [
            'country_id' => ['required_if:type,'.User::CUSTOMER_TYPE, 'exists:countries,id'],
            'city_id' => ['required_if:type,'.User::CUSTOMER_TYPE, 'exists:cities,id'],
            'manager_id' => ['required_if:type,'.User::CUSTOMER_TYPE, 'exists:users,id'],
            // 'employee_id' => ['required_if:type,'.User::CUSTOMER_TYPE, 'exists:users,id'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['nullable', 'file'],
            'settings' => ['nullable', 'array'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $resource = Str::plural(request()->query('type', User::CUSTOMER_TYPE));
        if (is_object($this->route('user')) && isset($this->route('user')->id)) {
            $resource = Str::plural($this->route('user')->type);
        }

        return trans($resource.'.attributes');
    }
}
