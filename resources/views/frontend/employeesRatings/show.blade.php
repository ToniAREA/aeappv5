@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.employeesRating.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.employees-ratings.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.employee') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->employee->id_employee ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.from_user') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->from_user->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.from_client') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->from_client->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.for_wlist') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->for_wlist->boat_namecomplete ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.for_wlog') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->for_wlog->date ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.rating') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->rating }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.comment') }}
                                        </th>
                                        <td>
                                            {{ $employeesRating->comment }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.employeesRating.fields.show_online') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $employeesRating->show_online ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.employees-ratings.index') }}">
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
