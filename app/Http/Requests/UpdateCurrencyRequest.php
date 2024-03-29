<?php

namespace App\Http\Requests;

use App\Models\Currency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('currency_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'min:3',
                'max:3',
                'required',
                'unique:currencies,code,' . request()->route('currency')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'symbol' => [
                'string',
                'required',
            ],
        ];
    }
}
