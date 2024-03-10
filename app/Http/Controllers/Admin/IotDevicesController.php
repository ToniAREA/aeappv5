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
use Yajra\DataTables\Facades\DataTables;

class IotDevicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('iot_device_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IotDevice::with(['product'])->select(sprintf('%s.*', (new IotDevice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'iot_device_show';
                $editGate      = 'iot_device_edit';
                $deleteGate    = 'iot_device_delete';
                $crudRoutePart = 'iot-devices';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('device', function ($row) {
                return $row->device ? $row->device : '';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('product.model', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->model) : '';
            });
            $table->editColumn('security_token', function ($row) {
                return $row->security_token ? $row->security_token : '';
            });
            $table->editColumn('serial_number', function ($row) {
                return $row->serial_number ? $row->serial_number : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? IotDevice::STATUS_RADIO[$row->status] : '';
            });
            $table->editColumn('additional_info', function ($row) {
                return $row->additional_info ? $row->additional_info : '';
            });
            $table->editColumn('source_code_link', function ($row) {
                return $row->source_code_link ? $row->source_code_link : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_name', function ($row) {
                return $row->link_name ? $row->link_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_active', 'product']);

            return $table->make(true);
        }

        return view('admin.iotDevices.index');
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
