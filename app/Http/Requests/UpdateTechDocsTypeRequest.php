<?php

namespace App\Http\Requests;

use App\Models\TechDocsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTechDocsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tech_docs_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
