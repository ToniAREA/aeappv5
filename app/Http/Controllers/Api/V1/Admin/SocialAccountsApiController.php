<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialAccountRequest;
use App\Http\Requests\UpdateSocialAccountRequest;
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

    public function store(StoreSocialAccountRequest $request)
    {
        $socialAccount = SocialAccount::create($request->all());

        return (new SocialAccountResource($socialAccount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SocialAccount $socialAccount)
    {
        abort_if(Gate::denies('social_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SocialAccountResource($socialAccount->load(['user']));
    }

    public function update(UpdateSocialAccountRequest $request, SocialAccount $socialAccount)
    {
        $socialAccount->update($request->all());

        return (new SocialAccountResource($socialAccount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SocialAccount $socialAccount)
    {
        abort_if(Gate::denies('social_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialAccount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
