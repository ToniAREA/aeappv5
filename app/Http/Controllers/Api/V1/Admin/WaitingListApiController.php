<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWaitingListRequest;
use App\Http\Requests\UpdateWaitingListRequest;
use App\Http\Resources\Admin\WaitingListResource;
use App\Models\WaitingList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WaitingListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('waiting_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WaitingListResource(WaitingList::with(['user', 'client', 'boats', 'plan'])->get());
    }

    public function store(StoreWaitingListRequest $request)
    {
        $waitingList = WaitingList::create($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return (new WaitingListResource($waitingList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WaitingListResource($waitingList->load(['user', 'client', 'boats', 'plan']));
    }

    public function update(UpdateWaitingListRequest $request, WaitingList $waitingList)
    {
        $waitingList->update($request->all());
        $waitingList->boats()->sync($request->input('boats', []));

        return (new WaitingListResource($waitingList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WaitingList $waitingList)
    {
        abort_if(Gate::denies('waiting_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $waitingList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
