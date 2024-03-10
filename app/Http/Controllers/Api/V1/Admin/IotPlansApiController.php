<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreIotPlanRequest;
use App\Http\Requests\UpdateIotPlanRequest;
use App\Http\Resources\Admin\IotPlanResource;
use App\Models\IotPlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IotPlansApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotPlanResource(IotPlan::all());
    }

    public function store(StoreIotPlanRequest $request)
    {
        $iotPlan = IotPlan::create($request->all());

        if ($request->input('contract', false)) {
            $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
        }

        return (new IotPlanResource($iotPlan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IotPlanResource($iotPlan);
    }

    public function update(UpdateIotPlanRequest $request, IotPlan $iotPlan)
    {
        $iotPlan->update($request->all());

        if ($request->input('contract', false)) {
            if (! $iotPlan->contract || $request->input('contract') !== $iotPlan->contract->file_name) {
                if ($iotPlan->contract) {
                    $iotPlan->contract->delete();
                }
                $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
            }
        } elseif ($iotPlan->contract) {
            $iotPlan->contract->delete();
        }

        return (new IotPlanResource($iotPlan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotPlan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
