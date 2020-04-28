<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'name' => 'min:1|max:40',
            'date_at' => 'date',
            'type' => 'regex:/income|expense/',
            'value' => 'regex:/^[0-9]+(\.[0-9]{1,2})?$/',
            'note' => 'max:2000',
            'is_pay' => 'boolean',
            'category_id' => 'integer|exists:categories',
            'account_id' => 'integer'
        ];
    }
}
