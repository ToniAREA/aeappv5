<?php

namespace App\Http\Requests;

use App\Models\WlistStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWlistStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlist_status_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
