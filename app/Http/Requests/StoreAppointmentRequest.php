<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_create');
    }

    public function rules()
    {
        return [
            'wlists.*' => [
                'integer',
            ],
            'wlists' => [
                'array',
            ],
            'for_roles.*' => [
                'integer',
            ],
            'for_roles' => [
                'array',
            ],
            'for_users.*' => [
                'integer',
            ],
            'for_users' => [
                'array',
            ],
            'boat_namecomplete' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'required',
            ],
            'private_comment' => [
                'string',
                'nullable',
            ],
            'when_starts' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'when_ends' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'notes' => [
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
