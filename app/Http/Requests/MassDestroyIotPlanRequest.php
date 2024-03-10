<?php

namespace App\Http\Requests;

use App\Models\IotPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIotPlanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('iot_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:iot_plans,id',
        ];
    }
}
