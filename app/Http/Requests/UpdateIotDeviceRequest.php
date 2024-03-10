<?php

namespace App\Http\Requests;

use App\Models\IotDevice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIotDeviceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('iot_device_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'device' => [
                'string',
                'nullable',
            ],
            'security_token' => [
                'string',
                'nullable',
            ],
            'serial_number' => [
                'string',
                'nullable',
            ],
            'source_code_link' => [
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
            'link_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
