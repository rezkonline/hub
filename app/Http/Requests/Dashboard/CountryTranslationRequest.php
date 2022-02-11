<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Traits\WithCountryId;
use Illuminate\Foundation\Http\FormRequest;

class CountryTranslationRequest extends FormRequest
{
    use WithCountryId;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('POST')) {
            return Gate::allows('create', CountryTranslation::class);
        }

        return Gate::allows('update', $this->route('translation'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'locale' => 'required|string',
        ];
    }
}
