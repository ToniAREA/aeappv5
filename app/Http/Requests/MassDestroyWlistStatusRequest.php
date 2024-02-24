<?php

namespace App\Http\Requests;

use App\Models\WlistStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWlistStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('wlist_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:wlist_statuses,id',
        ];
    }
}
