<?php

namespace App\Http\Requests;

use App\Models\SocialAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySocialAccountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('social_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:social_accounts,id',
        ];
    }
}
