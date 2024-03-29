<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuscriptionRequest;
use App\Http\Requests\UpdateSuscriptionRequest;
use App\Http\Resources\Admin\SuscriptionResource;
use App\Models\Suscription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuscriptionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuscriptionResource(Suscription::with(['user', 'client', 'boats', 'plan', 'financial_document'])->get());
    }

    public function store(StoreSuscriptionRequest $request)
    {
        $suscription = Suscription::create($request->all());
        $suscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        return (new SuscriptionResource($suscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuscriptionResource($suscription->load(['user', 'client', 'boats', 'plan', 'financial_document']));
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

        return (new SuscriptionResource($suscription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
