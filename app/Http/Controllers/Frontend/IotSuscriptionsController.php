<?php

namespace App\Http\Controllers\Frontend;

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

class IotSuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotSuscriptions = IotSuscription::with(['user', 'client', 'boats', 'plan', 'device', 'financial_document', 'media'])->get();

        return view('frontend.iotSuscriptions.index', compact('iotSuscriptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('iot_suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = IotPlan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.iotSuscriptions.create', compact('boats', 'clients', 'devices', 'financial_documents', 'plans', 'users'));
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

        return redirect()->route('frontend.iot-suscriptions.index');
    }

    public function edit(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = IotPlan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $devices = IotDevice::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iotSuscription->load('user', 'client', 'boats', 'plan', 'device', 'financial_document');

        return view('frontend.iotSuscriptions.edit', compact('boats', 'clients', 'devices', 'financial_documents', 'iotSuscription', 'plans', 'users'));
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

        return redirect()->route('frontend.iot-suscriptions.index');
    }

    public function show(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotSuscription->load('user', 'client', 'boats', 'plan', 'device', 'financial_document');

        return view('frontend.iotSuscriptions.show', compact('iotSuscription'));
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
