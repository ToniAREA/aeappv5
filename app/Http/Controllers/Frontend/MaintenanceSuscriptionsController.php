<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaintenanceSuscriptionRequest;
use App\Http\Requests\StoreMaintenanceSuscriptionRequest;
use App\Http\Requests\UpdateMaintenanceSuscriptionRequest;
use App\Models\Boat;
use App\Models\CarePlan;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\MaintenanceSuscription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceSuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenance_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscriptions = MaintenanceSuscription::with(['user', 'client', 'boats', 'care_plan', 'financial_document', 'media'])->get();

        return view('frontend.maintenanceSuscriptions.index', compact('maintenanceSuscriptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $care_plans = CarePlan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.maintenanceSuscriptions.create', compact('boats', 'care_plans', 'clients', 'financial_documents', 'users'));
    }

    public function store(StoreMaintenanceSuscriptionRequest $request)
    {
        $maintenanceSuscription = MaintenanceSuscription::create($request->all());
        $maintenanceSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $maintenanceSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $maintenanceSuscription->id]);
        }

        return redirect()->route('frontend.maintenance-suscriptions.index');
    }

    public function edit(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $care_plans = CarePlan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenanceSuscription->load('user', 'client', 'boats', 'care_plan', 'financial_document');

        return view('frontend.maintenanceSuscriptions.edit', compact('boats', 'care_plans', 'clients', 'financial_documents', 'maintenanceSuscription', 'users'));
    }

    public function update(UpdateMaintenanceSuscriptionRequest $request, MaintenanceSuscription $maintenanceSuscription)
    {
        $maintenanceSuscription->update($request->all());
        $maintenanceSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            if (! $maintenanceSuscription->signed_contract || $request->input('signed_contract') !== $maintenanceSuscription->signed_contract->file_name) {
                if ($maintenanceSuscription->signed_contract) {
                    $maintenanceSuscription->signed_contract->delete();
                }
                $maintenanceSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
            }
        } elseif ($maintenanceSuscription->signed_contract) {
            $maintenanceSuscription->signed_contract->delete();
        }

        return redirect()->route('frontend.maintenance-suscriptions.index');
    }

    public function show(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscription->load('user', 'client', 'boats', 'care_plan', 'financial_document');

        return view('frontend.maintenanceSuscriptions.show', compact('maintenanceSuscription'));
    }

    public function destroy(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscription->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenanceSuscriptionRequest $request)
    {
        $maintenanceSuscriptions = MaintenanceSuscription::find(request('ids'));

        foreach ($maintenanceSuscriptions as $maintenanceSuscription) {
            $maintenanceSuscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('maintenance_suscription_create') && Gate::denies('maintenance_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MaintenanceSuscription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
