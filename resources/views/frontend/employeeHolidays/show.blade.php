@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.employeeHoliday.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.employee-holidays.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->employee->id_employee ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.days_taken') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->days_taken }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.is_completed') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $employeeHoliday->is_completed ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeHoliday.fields.internalnotes') }}
                                    </th>
                                    <td>
                                        {{ $employeeHoliday->internalnotes }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.employee-holidays.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection