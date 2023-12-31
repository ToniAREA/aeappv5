@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.availability.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.id') }}
                        </th>
                        <td>
                            {{ $availability->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.employee') }}
                        </th>
                        <td>
                            {{ $availability->employee->id_employee ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.star_time') }}
                        </th>
                        <td>
                            {{ $availability->star_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.end_time') }}
                        </th>
                        <td>
                            {{ $availability->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.rate_multiplier') }}
                        </th>
                        <td>
                            {{ $availability->rate_multiplier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.availability.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Availability::STATUS_SELECT[$availability->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection