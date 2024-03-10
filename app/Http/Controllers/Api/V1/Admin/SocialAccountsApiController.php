<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SocialAccountResource;
use App\Models\SocialAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialAccountsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('social_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SocialAccountResource(SocialAccount::with(['user'])->get());
    }
}
