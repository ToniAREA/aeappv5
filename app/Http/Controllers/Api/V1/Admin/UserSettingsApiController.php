<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserSettingRequest;
use App\Http\Requests\UpdateUserSettingRequest;
use App\Http\Resources\Admin\UserSettingResource;
use App\Models\UserSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserSettingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserSettingResource(UserSetting::with(['user'])->get());
    }

    public function store(StoreUserSettingRequest $request)
    {
        $userSetting = UserSetting::create($request->all());

        return (new UserSettingResource($userSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserSetting $userSetting)
    {
        abort_if(Gate::denies('user_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserSettingResource($userSetting->load(['user']));
    }

    public function update(UpdateUserSettingRequest $request, UserSetting $userSetting)
    {
        $userSetting->update($request->all());

        return (new UserSettingResource($userSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserSetting $userSetting)
    {
        abort_if(Gate::denies('user_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
