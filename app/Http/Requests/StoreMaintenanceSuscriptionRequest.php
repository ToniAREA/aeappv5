<?php

namespace App\Http\Requests;

use App\Models\MaintenanceSuscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaintenanceSuscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintenance_suscription_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'required',
                'array',
            ],
            'care_plan_id' => [
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
