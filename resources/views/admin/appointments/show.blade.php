@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.client') }}
                        </th>
                        <td>
                            {{ $appointment->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.boat') }}
                        </th>
                        <td>
                            {{ $appointment->boat->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.wlists') }}
                        </th>
                        <td>
                            @foreach($appointment->wlists as $key => $wlists)
                                <span class="label label-info">{{ $wlists->description }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.for_role') }}
                        </th>
                        <td>
                            @foreach($appointment->for_roles as $key => $for_role)
                                <span class="label label-info">{{ $for_role->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.for_employees') }}
                        </th>
                        <td>
                            @foreach($appointment->for_employees as $key => $for_employees)
                                <span class="label label-info">{{ $for_employees->id_employee }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.boat_namecomplete') }}
                        </th>
                        <td>
                            {{ $appointment->boat_namecomplete }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.in_marina') }}
                        </th>
                        <td>
                            {{ $appointment->in_marina->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.description') }}
                        </th>
                        <td>
                            {{ $appointment->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.private_comment') }}
                        </th>
                        <td>
                            {{ $appointment->private_comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.when_starts') }}
                        </th>
                        <td>
                            {{ $appointment->when_starts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.when_ends') }}
                        </th>
                        <td>
                            {{ $appointment->when_ends }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.priority') }}
                        </th>
                        <td>
                            {{ $appointment->priority }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>
                        <td>
                            {{ $appointment->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.notes') }}
                        </th>
                        <td>
                            {{ $appointment->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $appointment->coordinates }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection