<?php

namespace App\Http\Requests;

use App\Models\Availability;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAvailabilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('availability_create');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'weekday' => [
                'string',
                'required',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'rate_multiplier' => [
                'numeric',
                'required',
                'unique:availabilities,rate_multiplier',
            ],
        ];
    }
}
