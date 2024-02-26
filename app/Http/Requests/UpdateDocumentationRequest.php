<?php

namespace App\Http\Requests;

use App\Models\Documentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('documentation_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'expiration_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'file' => [
                'required',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'link_description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
