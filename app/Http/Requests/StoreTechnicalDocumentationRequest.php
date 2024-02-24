<?php

namespace App\Http\Requests;

use App\Models\TechnicalDocumentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTechnicalDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('technical_documentation_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
            'seo_meta_description' => [
                'string',
                'nullable',
            ],
            'seo_slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
