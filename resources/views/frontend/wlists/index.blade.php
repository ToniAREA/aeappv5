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
                            {{ trans('cruds.wlist.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('wlist_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.wlists.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.wlist.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Wlist',
                                    'route' => 'admin.wlists.parseCsvImport',
                                ])

                            </span>
                        @endcan
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Wlist">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ trans('cruds.wlist.fields.client') }}</th>
                                        <th>{{ trans('cruds.client.fields.lastname') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.order_type') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.boat') }}</th>
                                        <th>{{ trans('cruds.boat.fields.boat_type') }}</th>

                                        <th>{{ trans('cruds.wlist.fields.for_role') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.for_employee') }}</th>
                                        <th>{{ trans('cruds.employee.fields.namecomplete') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.boat_namecomplete') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.description') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.estimated_hours') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.photos') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.deadline') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.status') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.priority') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.proforma_link') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.notes') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.link') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.link_description') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.last_use') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.completed_at') }}</th>
                                        <th>{{ trans('cruds.wlist.fields.financial_document') }}</th>
                                        <th>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wlists as $wl)
                                        @php
                                            $backgroundColor = '';
                                            if ($wl->status_id == 1) {
                                                $backgroundColor = 'background-color: #FFFACD;';
                                            } elseif ($wl->status_id == 2) {
                                                $backgroundColor = 'background-color: #90EE90;';
                                            }
                                        @endphp
                                        <tr onclick="window.location.href='{{ route('frontend.wlists.show', $wl->id) }}'"
                                            style="cursor: pointer; {{ $backgroundColor }}">
                                            <td style="text-align: center">{{ $wl->id }}</td>
                                            <td>{{ $wl->client->name ?? '' }}</td>
                                            <td>{{ $wl->client->lastname ?? '' }}</td>
                                            <td>{{ App\Models\Wlist::ORDER_TYPE_RADIO[$wl->order_type] ?? '' }}</td>
                                            <td>{{ $wl->boat->name ?? '' }}</td>
                                            <td>{{ $wl->boat->boat_type ?? '' }}</td>

                                            <td>
                                                @foreach ($wl->for_roles as $key => $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $wl->for_employee->id_employee ?? '' }}</td>
                                            <td>{{ $wl->for_employee->namecomplete ?? '' }}</td>
                                            <td>{{ $wl->boat_namecomplete ?? '' }}</td>
                                            <td>{{ $wl->description ?? '' }}</td>
                                            <td>{{ $wl->estimated_hours ?? '' }}</td>
                                            <td>
                                                @foreach ($wl->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ $wl->deadline ?? '' }}</td>
                                            <td>{{ $wl->status->name ?? '' }}</td>
                                            <td>{{ $wl->priority ?? '' }}</td>
                                            <td>{{ $wl->proforma_link ?? '' }}</td>
                                            <td>{{ $wl->notes ?? '' }}</td>
                                            <td>{{ $wl->internal_notes ?? '' }}</td>
                                            <td>{{ $wl->link ?? '' }}</td>
                                            <td>{{ $wl->link_description ?? '' }}</td>
                                            <td>{{ $wl->last_use ?? '' }}</td>
                                            <td>{{ $wl->completed_at ?? '' }}</td>
                                            <td>{{ $wl->financial_document->reference_number ?? '' }}</td>
                                            <td>
                                                @if ($wl->financial_document)
                                                    {{ $wl->financial_document::DOC_TYPE_RADIO[$wl->financial_document->doc_type] ?? '' }}
                                                @endif
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
                let table = $('.datatable-Wlist:not(.ajaxTable)').DataTable({
                    buttons: dtButtons
                })
            })
        </script>
    @endsection
