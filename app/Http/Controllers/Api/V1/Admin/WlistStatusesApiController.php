<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWlistStatusRequest;
use App\Http\Requests\UpdateWlistStatusRequest;
use App\Http\Resources\Admin\WlistStatusResource;
use App\Models\WlistStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlistStatusesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wlist_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistStatusResource(WlistStatus::all());
    }

    public function store(StoreWlistStatusRequest $request)
    {
        $wlistStatus = WlistStatus::create($request->all());

        return (new WlistStatusResource($wlistStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WlistStatus $wlistStatus)
    {
        abort_if(Gate::denies('wlist_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlistStatusResource($wlistStatus);
    }

    public function update(UpdateWlistStatusRequest $request, WlistStatus $wlistStatus)
    {
        $wlistStatus->update($request->all());

        return (new WlistStatusResource($wlistStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WlistStatus $wlistStatus)
    {
        abort_if(Gate::denies('wlist_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlistStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
