<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserSettingRequest;
use App\Http\Requests\StoreUserSettingRequest;
use App\Http\Requests\UpdateUserSettingRequest;
use App\Models\User;
use App\Models\UserSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserSettingsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSettings = UserSetting::with(['user'])->get();

        return view('admin.userSettings.index', compact('userSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userSettings.create', compact('users'));
    }

    public function store(StoreUserSettingRequest $request)
    {
        $userSetting = UserSetting::create($request->all());

        return redirect()->route('admin.user-settings.index');
    }

    public function edit(UserSetting $userSetting)
    {
        abort_if(Gate::denies('user_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userSetting->load('user');

        return view('admin.userSettings.edit', compact('userSetting', 'users'));
    }

    public function update(UpdateUserSettingRequest $request, UserSetting $userSetting)
    {
        $userSetting->update($request->all());

        return redirect()->route('admin.user-settings.index');
    }

    public function show(UserSetting $userSetting)
    {
        abort_if(Gate::denies('user_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSetting->load('user');

        return view('admin.userSettings.show', compact('userSetting'));
    }

    public function destroy(UserSetting $userSetting)
    {
        abort_if(Gate::denies('user_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserSettingRequest $request)
    {
        $userSettings = UserSetting::find(request('ids'));

        foreach ($userSettings as $userSetting) {
            $userSetting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
