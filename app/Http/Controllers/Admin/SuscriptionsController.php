<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuscriptionRequest;
use App\Http\Requests\StoreSuscriptionRequest;
use App\Http\Requests\UpdateSuscriptionRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\Plan;
use App\Models\Suscription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscriptions = Suscription::with(['user', 'client', 'boats', 'plan', 'financial_document', 'media'])->get();

        return view('admin.suscriptions.index', compact('suscriptions'));
    }

    public function create()
    {
        abort_if(Gate::denies('suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suscriptions.create', compact('boats', 'clients', 'financial_documents', 'plans', 'users'));
    }

    public function store(StoreSuscriptionRequest $request)
    {
        $suscription = Suscription::create($request->all());
        $suscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suscription->id]);
        }

        return redirect()->route('admin.suscriptions.index');
    }

    public function edit(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suscription->load('user', 'client', 'boats', 'plan', 'financial_document');

        return view('admin.suscriptions.edit', compact('boats', 'clients', 'financial_documents', 'plans', 'suscription', 'users'));
    }

    public function update(UpdateSuscriptionRequest $request, Suscription $suscription)
    {
        $suscription->update($request->all());
        $suscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            if (! $suscription->signed_contract || $request->input('signed_contract') !== $suscription->signed_contract->file_name) {
                if ($suscription->signed_contract) {
                    $suscription->signed_contract->delete();
                }
                $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
            }
        } elseif ($suscription->signed_contract) {
            $suscription->signed_contract->delete();
        }

        return redirect()->route('admin.suscriptions.index');
    }

    public function show(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscription->load('user', 'client', 'boats', 'plan', 'financial_document');

        return view('admin.suscriptions.show', compact('suscription'));
    }

    public function destroy(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscription->delete();

        return back();
    }

    public function massDestroy(MassDestroySuscriptionRequest $request)
    {
        $suscriptions = Suscription::find(request('ids'));

        foreach ($suscriptions as $suscription) {
            $suscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('suscription_create') && Gate::denies('suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Suscription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
