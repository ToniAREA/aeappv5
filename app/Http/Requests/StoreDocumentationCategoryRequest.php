<?php

namespace App\Http\Requests;

use App\Models\DocumentationCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDocumentationCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('documentation_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'authorized_roles.*' => [
                'integer',
            ],
            'authorized_roles' => [
                'array',
            ],
            'authorized_users.*' => [
                'integer',
            ],
            'authorized_users' => [
                'array',
            ],
        ];
    }
}
