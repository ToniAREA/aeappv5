<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\SocialAccount;
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
}
