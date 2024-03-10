<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIotSuscriptionRequest;
use App\Http\Requests\StoreIotSuscriptionRequest;
use App\Http\Requests\UpdateIotSuscriptionRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\IotDevice;
use App\Models\IotPlan;
use App\Models\IotSuscription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IotSuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('iot_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IotSuscription::with(['user', 'financial_document', 'client', 'boats', 'plan', 'device'])->select(sprintf('%s.*', (new IotSuscription)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'iot_suscription_show';
                $editGate      = 'iot_suscription_edit';
                $deleteGate    = 'iot_suscription_delete';
                $crudRoutePart = 'iot-suscriptions';

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
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
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
            $table->editColumn('signed_contract', function ($row) {
                return $row->signed_contract ? '<a href="' . $row->signed_contract->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->editColumn('hourly_rate_discount', function ($row) {
                return $row->hourly_rate_discount ? $row->hourly_rate_discount : '';
            });
            $table->editColumn('material_discount', function ($row) {
                return $row->material_discount ? $row->material_discount : '';
            });
            $table->addColumn('device_name', function ($row) {
                return $row->device ? $row->device->name : '';
            });

            $table->editColumn('device.serial_number', function ($row) {
                return $row->device ? (is_string($row->device) ? $row->device : $row->device->serial_number) : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'financial_document', 'is_active', 'client', 'boats', 'plan', 'signed_contract', 'device']);

            return $table->make(true);
        }

        return view('admin.iotSuscriptions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('iot_suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = IotPlan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.iotSuscriptions.create', compact('boats', 'clients', 'devices', 'financial_documents', 'plans', 'users'));
    }

    public function store(StoreIotSuscriptionRequest $request)
    {
        $iotSuscription = IotSuscription::create($request->all());
        $iotSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $iotSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $iotSuscription->id]);
        }

        return redirect()->route('admin.iot-suscriptions.index');
    }

    public function edit(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = IotPlan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iotSuscription->load('user', 'financial_document', 'client', 'boats', 'plan', 'device');

        return view('admin.iotSuscriptions.edit', compact('boats', 'clients', 'devices', 'financial_documents', 'iotSuscription', 'plans', 'users'));
    }

    public function update(UpdateIotSuscriptionRequest $request, IotSuscription $iotSuscription)
    {
        $iotSuscription->update($request->all());
        $iotSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            if (! $iotSuscription->signed_contract || $request->input('signed_contract') !== $iotSuscription->signed_contract->file_name) {
                if ($iotSuscription->signed_contract) {
                    $iotSuscription->signed_contract->delete();
                }
                $iotSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
            }
        } elseif ($iotSuscription->signed_contract) {
            $iotSuscription->signed_contract->delete();
        }

        return redirect()->route('admin.iot-suscriptions.index');
    }

    public function show(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotSuscription->load('user', 'financial_document', 'client', 'boats', 'plan', 'device');

        return view('admin.iotSuscriptions.show', compact('iotSuscription'));
    }

    public function destroy(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotSuscription->delete();

        return back();
    }

    public function massDestroy(MassDestroyIotSuscriptionRequest $request)
    {
        $iotSuscriptions = IotSuscription::find(request('ids'));

        foreach ($iotSuscriptions as $iotSuscription) {
            $iotSuscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('iot_suscription_create') && Gate::denies('iot_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new IotSuscription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
