@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.boat.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('boat_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.boats.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.boat.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Boat',
                                    'route' => 'admin.boats.parseCsvImport',
                                ])

                                <a class="btn btn-secondary btn-sm" href="{{ route('frontend.marinas.index') }}">
                                    >>
                                </a>
                                
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Boat">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.boat.fields.id') }}</th>
                                        {{-- <th>{{ trans('cruds.boat.fields.ref') }}</th> 
                                        <th>{{ trans('cruds.boat.fields.boat_type') }}</th>--}}
                                        <th>{{ trans('cruds.boat.fields.name') }}</th>
                                        {{-- <th>{{ trans('cruds.boat.fields.boat_photo') }}</th>
                                        <th>{{ trans('cruds.boat.fields.imo') }}</th>
                                        <th>{{ trans('cruds.boat.fields.mmsi') }}</th>
                                        <th>{{ trans('cruds.boat.fields.marina') }}</th>
                                        <th>{{ trans('cruds.boat.fields.sat_phone') }}</th>
                                        <th>{{ trans('cruds.boat.fields.notes') }}</th>
                                        <th>{{ trans('cruds.boat.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.boat.fields.clients') }}</th>
                                        <th>{{ trans('cruds.boat.fields.link') }}</th>
                                        <th>{{ trans('cruds.boat.fields.link_description') }}</th>
                                        <th>{{ trans('cruds.boat.fields.last_use') }}</th>
                                        <th>{{ trans('cruds.boat.fields.settings_data') }}</th>
                                        <th>{{ trans('cruds.boat.fields.public_ip') }}</th>
                                        <th>{{ trans('cruds.boat.fields.coordinates') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($boats as $boat)
                                        <tr onclick="window.location.href='{{ route('frontend.boats.show', $boat->id) }}'"
                                            style="cursor: pointer;">
                                            <td style="text-align: center">{{ $boat->id }}</td>
                                            {{-- <td>{{ $boat->ref ?? '' }}</td> --}}
                                           {{--  <td>{{ $boat->boat_type ?? '' }}</td> --}}
                                            <td>{{ $boat->boat_type ?? '' }} {{ $boat->name ?? '' }}</td>
                                           {{--  <td>
                                                @if ($boat->boat_photo)
                                                    <a href="{{ $boat->boat_photo->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $boat->boat_photo->getUrl('thumb') }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $boat->imo ?? '' }}</td>
                                            <td>{{ $boat->mmsi ?? '' }}</td>
                                            <td>{{ $boat->marina->name ?? '' }}</td>
                                            <td>{{ $boat->sat_phone ?? '' }}</td>
                                            <td>{{ $boat->notes ?? '' }}</td>
                                            <td>{{ $boat->internal_notes ?? '' }}</td>
                                            <td>
                                                @foreach ($boat->clients as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $boat->link ?? '' }}</td>
                                            <td>{{ $boat->link_description ?? '' }}</td>
                                            <td>{{ $boat->last_use ?? '' }}</td>
                                            <td>{{ $boat->settings_data ?? '' }}</td>
                                            <td>{{ $boat->public_ip ?? '' }}</td>
                                            <td>{{ $boat->coordinates ?? '' }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                let table = $('.datatable-Boat:not(.ajaxTable)').DataTable({
                    buttons: dtButtons
                })
            })
        </script>
    @endsection
