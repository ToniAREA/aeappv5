<?php

namespace App\Http\Requests;

use App\Models\ToDo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateToDoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('to_do_edit');
    }

    public function rules()
    {
        return [
            'task' => [
                'string',
                'max:200',
                'nullable',
            ],
            'for_roles.*' => [
                'integer',
            ],
            'for_roles' => [
                'array',
            ],
            'deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'priority' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'repeat_interval_value' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'completed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
