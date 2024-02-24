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

        return new SuscriptionResource(Suscription::with(['user', 'proforma', 'client'])->get());
    }

    public function store(StoreSuscriptionRequest $request)
    {
        $suscription = Suscription::create($request->all());

        if ($request->input('contract', false)) {
            $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
        }

        return (new SuscriptionResource($suscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuscriptionResource($suscription->load(['user', 'proforma', 'client']));
    }

    public function update(UpdateSuscriptionRequest $request, Suscription $suscription)
    {
        $suscription->update($request->all());

        if ($request->input('contract', false)) {
            if (! $suscription->contract || $request->input('contract') !== $suscription->contract->file_name) {
                if ($suscription->contract) {
                    $suscription->contract->delete();
                }
                $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
            }
        } elseif ($suscription->contract) {
            $suscription->contract->delete();
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
