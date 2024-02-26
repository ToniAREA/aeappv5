<?php

namespace App\Http\Requests;

use App\Models\Insurance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInsuranceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('insurance_edit');
    }

    public function rules()
    {
        return [
            'provider_name' => [
                'string',
                'required',
            ],
            'policy_number' => [
                'string',
                'nullable',
            ],
            'coverage_type' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'files' => [
                'array',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internalnotes' => [
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
            'contacts.*' => [
                'integer',
            ],
            'contacts' => [
                'array',
            ],
        ];
    }
}
