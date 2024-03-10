<?php

namespace App\Http\Requests;

use App\Models\IotReceivedData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIotReceivedDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('iot_received_data_edit');
    }

    public function rules()
    {
        return [
            'security_token' => [
                'string',
                'nullable',
            ],
            'service_voltage' => [
                'numeric',
            ],
            'engine_1_voltage' => [
                'numeric',
            ],
            'engine_2_voltage' => [
                'numeric',
            ],
        ];
    }
}
