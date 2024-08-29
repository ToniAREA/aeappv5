<?php

namespace App\Http\Requests;

use App\Models\IotPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIotPlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('iot_plan_create');
    }

    public function rules()
    {
        return [
            'plan_name' => [
                'string',
                'nullable',
            ],
            'short_description' => [
                'string',
                'required',
            ],
            'period_price' => [
                'required',
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
