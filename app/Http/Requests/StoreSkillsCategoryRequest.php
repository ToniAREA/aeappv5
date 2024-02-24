<?php

namespace App\Http\Requests;

use App\Models\SkillsCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSkillsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('skills_category_create');
    }

    public function rules()
    {
        return [
            'subject' => [
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
