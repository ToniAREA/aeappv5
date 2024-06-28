@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.wlog.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('wlog_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.wlogs.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.wlog.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Wlog',
                                    'route' => 'admin.wlogs.parseCsvImport',
                                ])

                                <a class="btn btn-secondary btn-sm" href="{{ route('frontend.mlogs.index') }}">
                                    >>
                                </a>
                                
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Wlog">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.wlog.fields.id') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.wlist') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.boat_namecomplete') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.date') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.employee') }}</th>
                                        <th>{{ trans('cruds.user.fields.email') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.marina') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.description') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.hours') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.hourly_rate') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.travel_cost_included') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.total_travel_cost') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.total_access_cost') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.wlist_finished') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.invoiced_line') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.notes') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.photos') }}</th>
                                        <th>{{ trans('cruds.wlog.fields.financial_document') }}</th>
                                        <th>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wlogs as $key => $wlog)
                                        <tr data-entry-id="{{ $wlog->id }}"  onclick="window.location.href='{{ route('frontend.wlogs.show', $wlog->id) }}'"
                                            style="cursor: pointer;">
                                            <td style="text-align: center">{{ $wlog->id ?? '' }}</td>
                                            <td>{{ $wlog->wlist->description ?? '' }}</td>
                                            <td>{{ $wlog->boat_namecomplete ?? '' }}</td>
                                            <td>{{ $wlog->date ?? '' }}</td>
                                            <td>{{ $wlog->employee->name ?? '' }}</td>
                                            <td>{{ $wlog->employee->email ?? '' }}</td>
                                            <td>{{ $wlog->marina->name ?? '' }}</td>
                                            <td>{{ $wlog->description ?? '' }}</td>
                                            <td>{{ $wlog->hours ?? '' }}</td>
                                            <td>{{ $wlog->hourly_rate ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $wlog->travel_cost_included ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $wlog->travel_cost_included ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $wlog->total_travel_cost ?? '' }}</td>
                                            <td>{{ $wlog->total_access_cost ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $wlog->wlist_finished ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $wlog->wlist_finished ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $wlog->invoiced_line ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $wlog->invoiced_line ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $wlog->notes ?? '' }}</td>
                                            <td>{{ $wlog->internal_notes ?? '' }}</td>
                                            <td>
                                                @foreach($wlog->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ $wlog->financial_document->reference_number ?? '' }}</td>
                                            <td>
                                                @if($wlog->financial_document)
                                                    {{ $wlog->financial_document::DOC_TYPE_RADIO[$wlog->financial_document->doc_type] ?? '' }}
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
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
           
          
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            let table = $('.datatable-Wlog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            
        })
    </script>
@endsection