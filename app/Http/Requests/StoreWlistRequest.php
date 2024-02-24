<?php

namespace App\Http\Requests;

use App\Models\Wlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlist_create');
    }

    public function rules()
    {
        return [
            'order_type' => [
                'required',
            ],
            'boat_id' => [
                'required',
                'integer',
            ],
            'for_roles.*' => [
                'integer',
            ],
            'for_roles' => [
                'array',
            ],
            'boat_namecomplete' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'estimated_hours' => [
                'numeric',
            ],
            'photos' => [
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
            'proforma_link' => [
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
            'completed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
