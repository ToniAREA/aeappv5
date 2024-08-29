<?php

namespace App\Http\Requests;

use App\Models\UserSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_setting_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
