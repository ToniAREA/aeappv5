<?php

namespace App\Http\Requests;

use App\Models\Bank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'branch' => [
                'string',
                'nullable',
            ],
            'account_number' => [
                'string',
                'required',
            ],
            'account_name' => [
                'string',
                'nullable',
            ],
            'swift_code' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'join_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'is_active' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'link_a' => [
                'string',
                'nullable',
            ],
            'link_a_description' => [
                'string',
                'nullable',
            ],
            'link_b' => [
                'string',
                'nullable',
            ],
            'link_b_description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
