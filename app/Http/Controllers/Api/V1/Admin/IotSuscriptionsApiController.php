<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreIotSuscriptionRequest;
use App\Http\Requests\UpdateIotSuscriptionRequest;
use App\Http\Resources\Admin\IotSuscriptionResource;
use App\Models\IotSuscription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotSuscriptionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotSuscriptionResource(IotSuscription::with(['user', 'client', 'boats', 'plan', 'device', 'financial_document'])->get());
    }

    public function store(StoreIotSuscriptionRequest $request)
    {
        $iotSuscription = IotSuscription::create($request->all());
        $iotSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $iotSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        return (new IotSuscriptionResource($iotSuscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotSuscriptionResource($iotSuscription->load(['user', 'client', 'boats', 'plan', 'device', 'financial_document']));
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

        return (new IotSuscriptionResource($iotSuscription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IotSuscription $iotSuscription)
    {
        abort_if(Gate::denies('iot_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotSuscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
