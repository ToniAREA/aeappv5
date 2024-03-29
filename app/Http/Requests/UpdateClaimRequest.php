<?php

namespace App\Http\Requests;

use App\Models\Claim;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClaimRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('claim_edit');
    }

    public function rules()
    {
        return [
            'claim_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'note' => [
                'string',
                'nullable',
            ],
        ];
    }
}
