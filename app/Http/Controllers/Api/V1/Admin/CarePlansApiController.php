<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCarePlanRequest;
use App\Http\Requests\UpdateCarePlanRequest;
use App\Http\Resources\Admin\CarePlanResource;
use App\Models\CarePlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarePlansApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('care_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarePlanResource(CarePlan::with(['checkpoints'])->get());
    }

    public function store(StoreCarePlanRequest $request)
    {
        $carePlan = CarePlan::create($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));
        if ($request->input('photo', false)) {
            $carePlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

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
        if ($request->input('photo', false)) {
            if (! $carePlan->photo || $request->input('photo') !== $carePlan->photo->file_name) {
                if ($carePlan->photo) {
                    $carePlan->photo->delete();
                }
                $carePlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($carePlan->photo) {
            $carePlan->photo->delete();
        }

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
