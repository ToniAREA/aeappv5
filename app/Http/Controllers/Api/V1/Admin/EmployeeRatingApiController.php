<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRatingRequest;
use App\Http\Requests\UpdateEmployeeRatingRequest;
use App\Http\Resources\Admin\EmployeeRatingResource;
use App\Models\EmployeeRating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeRatingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeRatingResource(EmployeeRating::with(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog'])->get());
    }

    public function store(StoreEmployeeRatingRequest $request)
    {
        $employeeRating = EmployeeRating::create($request->all());

        return (new EmployeeRatingResource($employeeRating))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeeRating $employeeRating)
    {
        abort_if(Gate::denies('employee_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeRatingResource($employeeRating->load(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog']));
    }

    public function update(UpdateEmployeeRatingRequest $request, EmployeeRating $employeeRating)
    {
        $employeeRating->update($request->all());

        return (new EmployeeRatingResource($employeeRating))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeeRating $employeeRating)
    {
        abort_if(Gate::denies('employee_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeRating->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
