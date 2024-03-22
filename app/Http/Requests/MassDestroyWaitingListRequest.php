<?php

namespace App\Http\Requests;

use App\Models\WaitingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWaitingListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('waiting_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:waiting_lists,id',
        ];
    }
}
