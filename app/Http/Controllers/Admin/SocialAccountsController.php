<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\SocialAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialAccountsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('social_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SocialAccount::with(['user'])->select(sprintf('%s.*', (new SocialAccount)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'social_account_show';
                $editGate      = 'social_account_edit';
                $deleteGate    = 'social_account_delete';
                $crudRoutePart = 'social-accounts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('provider', function ($row) {
                return $row->provider ? $row->provider : '';
            });
            $table->editColumn('id_provider', function ($row) {
                return $row->id_provider ? $row->id_provider : '';
            });
            $table->editColumn('token', function ($row) {
                return $row->token ? $row->token : '';
            });
            $table->editColumn('refresh_token', function ($row) {
                return $row->refresh_token ? $row->refresh_token : '';
            });
            $table->editColumn('expires_in', function ($row) {
                return $row->expires_in ? $row->expires_in : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.socialAccounts.index');
    }
}
