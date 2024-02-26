<?php

namespace App\Http\Requests;

use App\Models\EmployeeHoliday;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeeHolidayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_holiday_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'days_taken' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internalnotes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
