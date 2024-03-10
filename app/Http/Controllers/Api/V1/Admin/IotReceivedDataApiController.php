<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIotReceivedDataRequest;
use App\Http\Requests\UpdateIotReceivedDataRequest;
use App\Http\Resources\Admin\IotReceivedDataResource;
use App\Models\IotReceivedData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotReceivedDataApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('iot_received_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotReceivedDataResource(IotReceivedData::with(['device'])->get());
    }

    public function store(StoreIotReceivedDataRequest $request)
    {
        $iotReceivedData = IotReceivedData::create($request->all());

        return (new IotReceivedDataResource($iotReceivedData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotReceivedDataResource($iotReceivedData->load(['device']));
    }

    public function update(UpdateIotReceivedDataRequest $request, IotReceivedData $iotReceivedData)
    {
        $iotReceivedData->update($request->all());

        return (new IotReceivedDataResource($iotReceivedData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotReceivedData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
