<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Transaction;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\WithCustomerId;

class TransactionRequest extends FormRequest
{
    use WithCustomerId;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', [Transaction::class, $this->route('user')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'integer'],
            'payment_type' => ['required'],
            'receipt' => ['nullable', 'file'],
            'note' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('transactions.attributes');
    }
}
