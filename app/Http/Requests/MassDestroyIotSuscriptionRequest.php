<?php

namespace App\Http\Requests;

use App\Models\IotSuscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIotSuscriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('iot_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:iot_suscriptions,id',
        ];
    }
}
