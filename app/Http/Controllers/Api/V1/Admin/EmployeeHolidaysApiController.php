<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeHolidayRequest;
use App\Http\Requests\UpdateEmployeeHolidayRequest;
use App\Http\Resources\Admin\EmployeeHolidayResource;
use App\Models\EmployeeHoliday;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeHolidaysApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_holiday_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeHolidayResource(EmployeeHoliday::with(['employee'])->get());
    }

    public function store(StoreEmployeeHolidayRequest $request)
    {
        $employeeHoliday = EmployeeHoliday::create($request->all());

        return (new EmployeeHolidayResource($employeeHoliday))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeeHoliday $employeeHoliday)
    {
        abort_if(Gate::denies('employee_holiday_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeHolidayResource($employeeHoliday->load(['employee']));
    }

    public function update(UpdateEmployeeHolidayRequest $request, EmployeeHoliday $employeeHoliday)
    {
        $employeeHoliday->update($request->all());

        return (new EmployeeHolidayResource($employeeHoliday))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeeHoliday $employeeHoliday)
    {
        abort_if(Gate::denies('employee_holiday_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeHoliday->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
