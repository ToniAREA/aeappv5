<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySocialAccountRequest;
use App\Http\Requests\StoreSocialAccountRequest;
use App\Http\Requests\UpdateSocialAccountRequest;
use App\Models\SocialAccount;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialAccountsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('social_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialAccounts = SocialAccount::with(['user'])->get();

        return view('frontend.socialAccounts.index', compact('socialAccounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('social_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.socialAccounts.create', compact('users'));
    }

    public function store(StoreSocialAccountRequest $request)
    {
        $socialAccount = SocialAccount::create($request->all());

        return redirect()->route('frontend.social-accounts.index');
    }

    public function edit(SocialAccount $socialAccount)
    {
        abort_if(Gate::denies('social_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $socialAccount->load('user');

        return view('frontend.socialAccounts.edit', compact('socialAccount', 'users'));
    }

    public function update(UpdateSocialAccountRequest $request, SocialAccount $socialAccount)
    {
        $socialAccount->update($request->all());

        return redirect()->route('frontend.social-accounts.index');
    }

    public function show(SocialAccount $socialAccount)
    {
        abort_if(Gate::denies('social_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialAccount->load('user');

        return view('frontend.socialAccounts.show', compact('socialAccount'));
    }

    public function destroy(SocialAccount $socialAccount)
    {
        abort_if(Gate::denies('social_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialAccountRequest $request)
    {
        $socialAccounts = SocialAccount::find(request('ids'));

        foreach ($socialAccounts as $socialAccount) {
            $socialAccount->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
