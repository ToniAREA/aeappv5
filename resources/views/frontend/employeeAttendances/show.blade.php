@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.employeeAttendance.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.employee-attendances.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeeAttendance.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $employeeAttendance->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeeAttendance.fields.employee') }}
                                        </th>
                                        <td>
                                            {{ $employeeAttendance->employee->id_employee ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeeAttendance.fields.date') }}
                                        </th>
                                        <td>
                                            {{ $employeeAttendance->date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeeAttendance.fields.arrival_time') }}
                                        </th>
                                        <td>
                                            {{ $employeeAttendance->arrival_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeeAttendance.fields.departure_time') }}
                                        </th>
                                        <td>
                                            {{ $employeeAttendance->departure_time }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.employee-attendances.index') }}">
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
