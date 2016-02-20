<?php
namespace Ivanchenko\Converter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest {

    public function rules()
    {
        return [
            'amount' => ['required', 'regex:/^[1-9]+(?:\.\d+)?$/'],
            'target_currency' => 'equal_currency',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'You need to input some amount of money',
            'amount.regex' => 'Amount has to be a number not less than 1 separated by "." if needed',
            'target_currency.equal_currency' => 'Currencies have to different to convert money',
        ];
    }

    public function authorize()
    {
        return true;
    }

}