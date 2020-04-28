<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'name' => 'required|min:1|max:40',
            'date_at' => 'required|date',
            'type' => ['required', 'regex:/income|expense/'],
            'value' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'note' => 'max:2000',
            'is_pay' => 'required|boolean',
            'category_id' => 'required|integer|exists:categories,id',
            'account_id' => 'required|integer',
        ];
    }
}
