<?php

namespace App\Http\Controllers\Frontend;

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

class WaitingListController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('waiting_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $waitingLists = WaitingList::with(['user', 'client', 'boats', 'plan'])->get();

        return view('frontend.waitingLists.index', compact('waitingLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('waiting_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.waitingLists.create', compact('boats', 'clients', 'plans', 'users'));
    }

    public function store(StoreWaitingListRequest $request)
    {
        $waitingList = WaitingList::create($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return redirect()->route('frontend.waiting-lists.index');
    }

    public function edit(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $waitingList->load('user', 'client', 'boats', 'plan');

        return view('frontend.waitingLists.edit', compact('boats', 'clients', 'plans', 'users', 'waitingList'));
    }

    public function update(UpdateWaitingListRequest $request, WaitingList $waitingList)
    {
        $waitingList->update($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return redirect()->route('frontend.waiting-lists.index');
    }

    public function show(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $waitingList->load('user', 'client', 'boats', 'plan');

        return view('frontend.waitingLists.show', compact('waitingList'));
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
