<?php

namespace App\Http\Requests;

use App\Models\IotReceivedData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIotReceivedDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('iot_received_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:iot_received_datas,id',
        ];
    }
}
