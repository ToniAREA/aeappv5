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
                'required',
            ],
            'short_description' => [
                'string',
                'required',
            ],
            'period' => [
                'required',
            ],
            'period_price' => [
                'required',
            ],
            'hourly_rate_discount' => [
                'numeric',
            ],
            'material_discount' => [
                'numeric',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'link_description' => [
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
