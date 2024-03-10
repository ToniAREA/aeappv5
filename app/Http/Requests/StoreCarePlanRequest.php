<?php

namespace App\Http\Requests;

use App\Models\CarePlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarePlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('care_plan_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'short_description' => [
                'string',
                'nullable',
            ],
            'checkpoints.*' => [
                'integer',
            ],
            'checkpoints' => [
                'required',
                'array',
            ],
            'period' => [
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
        ];
    }
}
