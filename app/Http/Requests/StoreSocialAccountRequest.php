<?php

namespace App\Http\Requests;

use App\Models\SocialAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSocialAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_account_create');
    }

    public function rules()
    {
        return [
            'provider' => [
                'string',
                'nullable',
            ],
            'id_provider' => [
                'string',
                'nullable',
            ],
            'token' => [
                'string',
                'nullable',
            ],
            'refresh_token' => [
                'string',
                'nullable',
            ],
            'expires_in' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
