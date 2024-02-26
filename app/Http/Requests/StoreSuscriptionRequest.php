<?php

namespace App\Http\Requests;

use App\Models\Suscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suscription_create');
    }

    public function rules()
    {
        return [
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'hourly_rate_discount' => [
                'numeric',
            ],
            'material_discount' => [
                'numeric',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'link_description' => [
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
            'completed_at' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
