<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAssetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_create');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'photos' => [
                'array',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'location_id' => [
                'required',
                'integer',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'data_1' => [
                'string',
                'nullable',
            ],
            'data_1_description' => [
                'string',
                'nullable',
            ],
            'data_2' => [
                'string',
                'nullable',
            ],
            'data_2_description' => [
                'string',
                'nullable',
            ],
            'files' => [
                'array',
            ],
            'link_a' => [
                'string',
                'nullable',
            ],
            'link_a_description' => [
                'string',
                'nullable',
            ],
            'link_b' => [
                'string',
                'nullable',
            ],
            'link_b_description' => [
                'string',
                'nullable',
            ],
            'last_use' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
