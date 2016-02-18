<?php
namespace Ivanchenco\Converter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest {

    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'target_currency' => 'equal_currency',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'You need to input some amount of money',
            'amount.numeric' => 'Amount has to be a number with separated by "." if needed',
            'target_currency.equal_currency' => 'Currencies have to different to convert money',
        ];
    }

    public function authorize()
    {
        return true;
    }

}