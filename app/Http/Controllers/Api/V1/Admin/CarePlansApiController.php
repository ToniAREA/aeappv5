<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarePlanRequest;
use App\Http\Requests\UpdateCarePlanRequest;
use App\Http\Resources\Admin\CarePlanResource;
use App\Models\CarePlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarePlansApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('care_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarePlanResource(CarePlan::with(['checkpoints'])->get());
    }

    public function store(StoreCarePlanRequest $request)
    {
        $carePlan = CarePlan::create($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));

        return (new CarePlanResource($carePlan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarePlanResource($carePlan->load(['checkpoints']));
    }

    public function update(UpdateCarePlanRequest $request, CarePlan $carePlan)
    {
        $carePlan->update($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));

        return (new CarePlanResource($carePlan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carePlan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
