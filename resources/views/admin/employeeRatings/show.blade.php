@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employeeRating.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employee-ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.id') }}
                        </th>
                        <td>
                            {{ $employeeRating->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.employee') }}
                        </th>
                        <td>
                            {{ $employeeRating->employee->id_employee ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.from_user') }}
                        </th>
                        <td>
                            {{ $employeeRating->from_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.from_client') }}
                        </th>
                        <td>
                            {{ $employeeRating->from_client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.for_wlist') }}
                        </th>
                        <td>
                            {{ $employeeRating->for_wlist->boat_namecomplete ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.for_wlog') }}
                        </th>
                        <td>
                            {{ $employeeRating->for_wlog->date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.rating') }}
                        </th>
                        <td>
                            {{ $employeeRating->rating }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.comment') }}
                        </th>
                        <td>
                            {{ $employeeRating->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeRating.fields.show_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $employeeRating->show_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employee-ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection