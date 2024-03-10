<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMaintenanceSuscriptionRequest;
use App\Http\Requests\UpdateMaintenanceSuscriptionRequest;
use App\Http\Resources\Admin\MaintenanceSuscriptionResource;
use App\Models\MaintenanceSuscription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceSuscriptionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('maintenance_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceSuscriptionResource(MaintenanceSuscription::with(['user', 'client', 'boats', 'care_plan', 'financial_document'])->get());
    }

    public function store(StoreMaintenanceSuscriptionRequest $request)
    {
        $maintenanceSuscription = MaintenanceSuscription::create($request->all());
        $maintenanceSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $maintenanceSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        return (new MaintenanceSuscriptionResource($maintenanceSuscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintenanceSuscriptionResource($maintenanceSuscription->load(['user', 'client', 'boats', 'care_plan', 'financial_document']));
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

        return (new MaintenanceSuscriptionResource($maintenanceSuscription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
