<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_create');
    }

    public function rules()
    {
        return [
            'plan_name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'duration_months' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
            'seo_meta_description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
