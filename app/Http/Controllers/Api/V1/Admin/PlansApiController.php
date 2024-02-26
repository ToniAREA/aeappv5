<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Http\Resources\Admin\PlanResource;
use App\Models\Plan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlansApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlanResource(Plan::all());
    }

    public function store(StorePlanRequest $request)
    {
        $plan = Plan::create($request->all());

        if ($request->input('contract', false)) {
            $plan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
        }

        return (new PlanResource($plan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Plan $plan)
    {
        abort_if(Gate::denies('plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlanResource($plan);
    }

    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->update($request->all());

        if ($request->input('contract', false)) {
            if (! $plan->contract || $request->input('contract') !== $plan->contract->file_name) {
                if ($plan->contract) {
                    $plan->contract->delete();
                }
                $plan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
            }
        } elseif ($plan->contract) {
            $plan->contract->delete();
        }

        return (new PlanResource($plan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Plan $plan)
    {
        abort_if(Gate::denies('plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $plan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
