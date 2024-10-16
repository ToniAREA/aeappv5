@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('appointment_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.appointments.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Appointment',
                                    'route' => 'admin.appointments.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Appointment">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.appointment.fields.id') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.client') }}</th>
                                        <th>{{ trans('cruds.client.fields.lastname') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.boat') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.wlists') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.for_role') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.for_employees') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.boat_namecomplete') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.in_marina') }}</th>
                                        <th>{{ trans('cruds.marina.fields.notes') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.description') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.private_comment') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.when_starts') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.when_ends') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.priority') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.status') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.notes') }}</th>
                                        <th>{{ trans('cruds.appointment.fields.coordinates') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr data-entry-id="{{ $appointment->id }}">
                                            <td style="text-align: center">{{ $appointment->id ?? '' }}</td>
                                            <td>{{ $appointment->client->name ?? '' }}</td>
                                            <td>{{ $appointment->client->lastname ?? '' }}</td>
                                            <td>{{ $appointment->boat->name ?? '' }}</td>
                                            <td>
                                                @foreach ($appointment->wlists as $item)
                                                    <span>{{ $item->description }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($appointment->for_roles as $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($appointment->for_employees as $item)
                                                    <span>{{ $item->id_employee }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $appointment->boat_namecomplete ?? '' }}</td>
                                            <td>{{ $appointment->in_marina->name ?? '' }}</td>
                                            <td>{{ $appointment->in_marina->notes ?? '' }}</td>
                                            <td>{{ $appointment->description ?? '' }}</td>
                                            <td>{{ $appointment->private_comment ?? '' }}</td>
                                            <td>{{ $appointment->when_starts ?? '' }}</td>
                                            <td>{{ $appointment->when_ends ?? '' }}</td>
                                            <td>{{ $appointment->priority ?? '' }}</td>
                                            <td>{{ $appointment->status ?? '' }}</td>
                                            <td>{{ $appointment->notes ?? '' }}</td>
                                            <td>{{ $appointment->coordinates ?? '' }}</td>
                                            <td>
                                                @can('appointment_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.appointments.show', $appointment->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('appointment_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.appointments.edit', $appointment->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('appointment_delete')
                                                    <form
                                                        action="{{ route('frontend.appointments.destroy', $appointment->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                        style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-Appointment:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })

        })
    </script>
@endsection
