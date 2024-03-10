<?php

namespace App\Http\Requests;

use App\Models\IotDevice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIotDeviceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('iot_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:iot_devices,id',
        ];
    }
}
