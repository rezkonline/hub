<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;

class MeetingRequest extends FormRequest
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
        return RuleFactory::make([
            '%name%' => 'required|string',
            '%description%' => 'required|string',
            'duration' => 'required|numeric|min:10',
            'start_at' => 'required|date_format:Y-m-d H:i|after:now',
            'customers' => 'required|array|min:1',
            'customers.*' => 'required|exists:users,id',
        ]);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return RuleFactory::make(trans('meetings.attributes'));
    }
}
