<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Achievement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('POST')) {
            return Gate::allows('create', [Achievement::class, $this->route('user')]);
        }

        return Gate::allows('update', $this->route('achievement'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'value' => ['required'],
            'customer_id' => ['required', 'exists:users,id'],
        ];
    }
}
