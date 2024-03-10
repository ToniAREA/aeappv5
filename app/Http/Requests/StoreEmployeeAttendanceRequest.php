<?php

namespace App\Http\Requests;

use App\Models\EmployeeAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_attendance_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'arrival_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'departure_time' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
