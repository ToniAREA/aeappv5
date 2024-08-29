<?php

namespace App\Http\Requests;

use App\Models\MaintenanceSuscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMaintenanceSuscriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('maintenance_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:maintenance_suscriptions,id',
        ];
    }
}
