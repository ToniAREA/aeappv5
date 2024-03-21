<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWaitingListRequest;
use App\Http\Requests\StoreWaitingListRequest;
use App\Http\Requests\UpdateWaitingListRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Plan;
use App\Models\User;
use App\Models\WaitingList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WaitingListController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('waiting_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WaitingList::with(['user', 'client', 'boats', 'plan'])->select(sprintf('%s.*', (new WaitingList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'waiting_list_show';
                $editGate      = 'waiting_list_edit';
                $deleteGate    = 'waiting_list_delete';
                $crudRoutePart = 'waiting-lists';

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

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('plan_plan_name', function ($row) {
                return $row->plan ? $row->plan->plan_name : '';
            });

            $table->editColumn('plan.short_description', function ($row) {
                return $row->plan ? (is_string($row->plan) ? $row->plan : $row->plan->short_description) : '';
            });
            $table->editColumn('waiting_for', function ($row) {
                return $row->waiting_for ? $row->waiting_for : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? WaitingList::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'client', 'boats', 'plan']);

            return $table->make(true);
        }

        return view('admin.waitingLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('waiting_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.waitingLists.create', compact('boats', 'clients', 'plans', 'users'));
    }

    public function store(StoreWaitingListRequest $request)
    {
        $waitingList = WaitingList::create($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.waiting-lists.index');
    }

    public function edit(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $waitingList->load('user', 'client', 'boats', 'plan');

        return view('admin.waitingLists.edit', compact('boats', 'clients', 'plans', 'users', 'waitingList'));
    }

    public function update(UpdateWaitingListRequest $request, WaitingList $waitingList)
    {
        $waitingList->update($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.waiting-lists.index');
    }

    public function show(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $waitingList->load('user', 'client', 'boats', 'plan');

        return view('admin.waitingLists.show', compact('waitingList'));
    }

    public function destroy(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $waitingList->delete();

        return back();
    }

    public function massDestroy(MassDestroyWaitingListRequest $request)
    {
        $waitingLists = WaitingList::find(request('ids'));

        foreach ($waitingLists as $waitingList) {
            $waitingList->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
