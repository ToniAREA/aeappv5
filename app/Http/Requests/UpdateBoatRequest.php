<?php

namespace App\Http\Requests;

use App\Models\Boat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBoatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boat_edit');
    }

    public function rules()
    {
        return [
            'ref' => [
                'string',
                'nullable',
            ],
            'boat_type' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'imo' => [
                'string',
                'nullable',
            ],
            'mmsi' => [
                'string',
                'nullable',
            ],
            'sat_phone' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'clients.*' => [
                'integer',
            ],
            'clients' => [
                'array',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'link_description' => [
                'string',
                'nullable',
            ],
            'last_use' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'public_ip' => [
                'string',
                'nullable',
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
        ];
    }
}
