<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvailabilityRequest;
use App\Http\Requests\UpdateAvailabilityRequest;
use App\Http\Resources\Admin\AvailabilityResource;
use App\Models\Availability;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvailabilityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AvailabilityResource(Availability::with(['employee'])->get());
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $availability = Availability::create($request->all());

        return (new AvailabilityResource($availability))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Availability $availability)
    {
        abort_if(Gate::denies('availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AvailabilityResource($availability->load(['employee']));
    }

    public function update(UpdateAvailabilityRequest $request, Availability $availability)
    {
        $availability->update($request->all());

        return (new AvailabilityResource($availability))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Availability $availability)
    {
        abort_if(Gate::denies('availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availability->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
