<?php

namespace App\Http\Requests;

use App\Models\Mlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mlog_edit');
    }

    public function rules()
    {
        return [
            'boat_id' => [
                'required',
                'integer',
            ],
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
            'item' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'units' => [
                'numeric',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
