<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIotDeviceRequest;
use App\Http\Requests\UpdateIotDeviceRequest;
use App\Http\Resources\Admin\IotDeviceResource;
use App\Models\IotDevice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotDevicesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('iot_device_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotDeviceResource(IotDevice::with(['product'])->get());
    }

    public function store(StoreIotDeviceRequest $request)
    {
        $iotDevice = IotDevice::create($request->all());

        return (new IotDeviceResource($iotDevice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IotDevice $iotDevice)
    {
        abort_if(Gate::denies('iot_device_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotDeviceResource($iotDevice->load(['product']));
    }

    public function update(UpdateIotDeviceRequest $request, IotDevice $iotDevice)
    {
        $iotDevice->update($request->all());

        return (new IotDeviceResource($iotDevice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IotDevice $iotDevice)
    {
        abort_if(Gate::denies('iot_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotDevice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
