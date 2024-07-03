@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('partials.smallmenu')

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.client.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('client_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.clients.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>

                                @include('csvImport.modal', [
                                    'model' => 'Client',
                                    'route' => 'admin.clients.parseCsvImport',
                                ])

                            </span>
                        @endcan
                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Client">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.client.fields.id') }}</th>
                                        {{-- <th>{{ trans('cruds.client.fields.has_active_vip_plan') }}</th>
                                        <th>{{ trans('cruds.client.fields.has_active_maintenance_plan') }}</th>
                                        <th>{{ trans('cruds.client.fields.defaulter') }}</th>
                                        <th>{{ trans('cruds.client.fields.ref') }}</th> --}}
                                        <th>{{ trans('cruds.client.fields.name') }}</th>
                                        {{--  <th>{{ trans('cruds.client.fields.lastname') }}</th>
                                        <th>{{ trans('cruds.client.fields.vat') }}</th>
                                        <th>{{ trans('cruds.client.fields.address') }}</th>
                                        <th>{{ trans('cruds.client.fields.country') }}</th>
                                        <th>{{ trans('cruds.client.fields.telephone') }}</th>
                                        <th>{{ trans('cruds.client.fields.mobile') }}</th>
                                        <th>{{ trans('cruds.client.fields.email') }}</th>
                                        <th>{{ trans('cruds.client.fields.contacts') }}</th>
                                        <th>{{ trans('cruds.client.fields.boats') }}</th>
                                        <th>{{ trans('cruds.client.fields.notes') }}</th>
                                        <th>{{ trans('cruds.client.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.client.fields.coordinates') }}</th>
                                        <th>{{ trans('cruds.client.fields.link_a') }}</th>
                                        <th>{{ trans('cruds.client.fields.link_a_description') }}</th>
                                        <th>{{ trans('cruds.client.fields.link_b') }}</th>
                                        <th>{{ trans('cruds.client.fields.link_b_description') }}</th>
                                        <th>{{ trans('cruds.client.fields.last_use') }}</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr onclick="window.location.href='{{ route('frontend.clients.show', $client->id) }}'"
                                            style="cursor: pointer;">
                                            <td style="text-align: center">{{ $client->id }}</td>
                                            {{--  <td>
                                                <span style="display:none">{{ $client->has_active_vip_plan ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $client->has_active_vip_plan ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <span
                                                    style="display:none">{{ $client->has_active_maintenance_plan ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $client->has_active_maintenance_plan ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $client->defaulter ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $client->defaulter ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $client->ref ?? '' }}</td> --}}
                                            <td>{{ $client->name ?? '' }}, {{ $client->lastname ?? '' }}</td>
                                            {{-- <td>{{ $client->lastname ?? '' }}</td>
                                            <td>{{ $client->vat ?? '' }}</td>
                                            <td>{{ $client->address ?? '' }}</td>
                                            <td>{{ $client->country ?? '' }}</td>
                                            <td>{{ $client->telephone ?? '' }}</td>
                                            <td>{{ $client->mobile ?? '' }}</td>
                                            <td>{{ $client->email ?? '' }}</td> --}}
                                            {{--  <td>
                                                @foreach ($client->contacts as $item)
                                                    <span>{{ $item->contact_first_name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($client->boats as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $client->notes ?? '' }}</td>
                                            <td>{{ $client->internal_notes ?? '' }}</td>
                                            <td>{{ $client->coordinates ?? '' }}</td>
                                            <td>{{ $client->link_a ?? '' }}</td>
                                            <td>{{ $client->link_a_description ?? '' }}</td>
                                            <td>{{ $client->link_b ?? '' }}</td>
                                            <td>{{ $client->link_b_description ?? '' }}</td>
                                            <td>{{ $client->last_use ?? '' }}</td> --}}
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
            let table = $('.datatable-Client:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
        })
    </script>
@endsection
