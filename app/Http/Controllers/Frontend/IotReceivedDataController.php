<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIotReceivedDataRequest;
use App\Http\Requests\StoreIotReceivedDataRequest;
use App\Http\Requests\UpdateIotReceivedDataRequest;
use App\Models\IotDevice;
use App\Models\IotReceivedData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotReceivedDataController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_received_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotReceivedDatas = IotReceivedData::with(['device'])->get();

        return view('frontend.iotReceivedDatas.index', compact('iotReceivedDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('iot_received_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.iotReceivedDatas.create', compact('devices'));
    }

    public function store(StoreIotReceivedDataRequest $request)
    {
        $iotReceivedData = IotReceivedData::create($request->all());

        return redirect()->route('frontend.iot-received-datas.index');
    }

    public function edit(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iotReceivedData->load('device');

        return view('frontend.iotReceivedDatas.edit', compact('devices', 'iotReceivedData'));
    }

    public function update(UpdateIotReceivedDataRequest $request, IotReceivedData $iotReceivedData)
    {
        $iotReceivedData->update($request->all());

        return redirect()->route('frontend.iot-received-datas.index');
    }

    public function show(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotReceivedData->load('device');

        return view('frontend.iotReceivedDatas.show', compact('iotReceivedData'));
    }

    public function destroy(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotReceivedData->delete();

        return back();
    }

    public function massDestroy(MassDestroyIotReceivedDataRequest $request)
    {
        $iotReceivedDatas = IotReceivedData::find(request('ids'));

        foreach ($iotReceivedDatas as $iotReceivedData) {
            $iotReceivedData->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
