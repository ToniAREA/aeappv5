<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class IotReceivedDataController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('iot_received_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IotReceivedData::with(['device'])->select(sprintf('%s.*', (new IotReceivedData)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'iot_received_data_show';
                $editGate      = 'iot_received_data_edit';
                $deleteGate    = 'iot_received_data_delete';
                $crudRoutePart = 'iot-received-datas';

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
            $table->addColumn('device_name', function ($row) {
                return $row->device ? $row->device->name : '';
            });

            $table->editColumn('device.status', function ($row) {
                return $row->device ? (is_string($row->device) ? $row->device : $row->device->status) : '';
            });
            $table->editColumn('security_token', function ($row) {
                return $row->security_token ? $row->security_token : '';
            });
            $table->editColumn('received_data', function ($row) {
                return $row->received_data ? $row->received_data : '';
            });
            $table->editColumn('service_voltage', function ($row) {
                return $row->service_voltage ? $row->service_voltage : '';
            });
            $table->editColumn('engine_1_voltage', function ($row) {
                return $row->engine_1_voltage ? $row->engine_1_voltage : '';
            });
            $table->editColumn('engine_2_voltage', function ($row) {
                return $row->engine_2_voltage ? $row->engine_2_voltage : '';
            });
            $table->editColumn('bilge_alarm', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->bilge_alarm ? 'checked' : null) . '>';
            });
            $table->editColumn('shore_alarm', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->shore_alarm ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'device', 'bilge_alarm', 'shore_alarm']);

            return $table->make(true);
        }

        return view('admin.iotReceivedDatas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('iot_received_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.iotReceivedDatas.create', compact('devices'));
    }

    public function store(StoreIotReceivedDataRequest $request)
    {
        $iotReceivedData = IotReceivedData::create($request->all());

        return redirect()->route('admin.iot-received-datas.index');
    }

    public function edit(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iotReceivedData->load('device');

        return view('admin.iotReceivedDatas.edit', compact('devices', 'iotReceivedData'));
    }

    public function update(UpdateIotReceivedDataRequest $request, IotReceivedData $iotReceivedData)
    {
        $iotReceivedData->update($request->all());

        return redirect()->route('admin.iot-received-datas.index');
    }

    public function show(IotReceivedData $iotReceivedData)
    {
        abort_if(Gate::denies('iot_received_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotReceivedData->load('device');

        return view('admin.iotReceivedDatas.show', compact('iotReceivedData'));
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
