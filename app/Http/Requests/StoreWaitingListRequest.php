<?php

namespace App\Http\Requests;

use App\Models\WaitingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWaitingListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('waiting_list_create');
    }

    public function rules()
    {
        return [
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
            'waiting_for' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
