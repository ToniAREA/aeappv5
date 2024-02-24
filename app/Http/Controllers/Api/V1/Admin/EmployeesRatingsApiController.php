<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeesRatingRequest;
use App\Http\Requests\UpdateEmployeesRatingRequest;
use App\Http\Resources\Admin\EmployeesRatingResource;
use App\Models\EmployeesRating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeesRatingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employees_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeesRatingResource(EmployeesRating::with(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog'])->get());
    }

    public function store(StoreEmployeesRatingRequest $request)
    {
        $employeesRating = EmployeesRating::create($request->all());

        return (new EmployeesRatingResource($employeesRating))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeesRating $employeesRating)
    {
        abort_if(Gate::denies('employees_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeesRatingResource($employeesRating->load(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog']));
    }

    public function update(UpdateEmployeesRatingRequest $request, EmployeesRating $employeesRating)
    {
        $employeesRating->update($request->all());

        return (new EmployeesRatingResource($employeesRating))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeesRating $employeesRating)
    {
        abort_if(Gate::denies('employees_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesRating->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
