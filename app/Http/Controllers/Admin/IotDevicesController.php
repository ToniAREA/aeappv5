<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIotDeviceRequest;
use App\Http\Requests\StoreIotDeviceRequest;
use App\Http\Requests\UpdateIotDeviceRequest;
use App\Models\IotDevice;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotDevicesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_device_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotDevices = IotDevice::with(['product'])->get();

        return view('admin.iotDevices.index', compact('iotDevices'));
    }

    public function create()
    {
        abort_if(Gate::denies('iot_device_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.iotDevices.create', compact('products'));
    }

    public function store(StoreIotDeviceRequest $request)
    {
        $iotDevice = IotDevice::create($request->all());

        return redirect()->route('admin.iot-devices.index');
    }

    public function edit(IotDevice $iotDevice)
    {
        abort_if(Gate::denies('iot_device_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iotDevice->load('product');

        return view('admin.iotDevices.edit', compact('iotDevice', 'products'));
    }

    public function update(UpdateIotDeviceRequest $request, IotDevice $iotDevice)
    {
        $iotDevice->update($request->all());

        return redirect()->route('admin.iot-devices.index');
    }

    public function show(IotDevice $iotDevice)
    {
        abort_if(Gate::denies('iot_device_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotDevice->load('product', 'deviceIotSuscriptions', 'deviceIotReceivedDatas');

        return view('admin.iotDevices.show', compact('iotDevice'));
    }

    public function destroy(IotDevice $iotDevice)
    {
        abort_if(Gate::denies('iot_device_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotDevice->delete();

        return back();
    }

    public function massDestroy(MassDestroyIotDeviceRequest $request)
    {
        $iotDevices = IotDevice::find(request('ids'));

        foreach ($iotDevices as $iotDevice) {
            $iotDevice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
