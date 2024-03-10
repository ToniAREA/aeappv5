<?php

namespace App\Http\Requests;

use App\Models\Wlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlog_create');
    }

    public function rules()
    {
        return [
            'boat_namecomplete' => [
                'string',
                'nullable',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'employee_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'required',
            ],
            'hours' => [
                'numeric',
                'required',
                'min:0',
                'max:24',
            ],
            'total_travel_cost' => [
                'numeric',
            ],
            'total_access_cost' => [
                'numeric',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
        ];
    }
}
