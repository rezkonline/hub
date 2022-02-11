<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Http\Requests\Traits\Api\WithAuthId;

class TaskRequest extends FormRequest
{
    use WithAuthId;

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
        }

        return $this->updateRules();
    }

    /**
     * Create rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(array_keys(trans('tasks.types')))],
        ];
    }

    /**
     * Update rules.
     *
     * @return array
     */
    public function updateRules()
    {
        return [
            'status' => ['required', Rule::in(array_keys(trans('tasks.types')))],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('tasks.attributes');
    }
}
