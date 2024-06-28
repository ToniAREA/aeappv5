@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.mlog.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('mlog_create')
                            <span>
                                <a class="btn btn-success btn-sm" href="{{ route('frontend.mlogs.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.mlog.title_singular') }}
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Mlog',
                                    'route' => 'admin.mlogs.parseCsvImport',
                                ])

                                <a class="btn btn-secondary btn-sm" href="{{ route('frontend.products.index') }}">
                                    >>
                                </a>
                                
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Mlog">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.mlog.fields.id') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.boat') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.boat_namecomplete') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.wlist') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.date') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.employee') }}</th>
                                        <th>{{ trans('cruds.user.fields.email') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.item') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.product') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.description') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.photos') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.units') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.price_unit') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.invoiced_line') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.mlog.fields.financial_document') }}</th>
                                        <th>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mlogs as $key => $mlog)
                                        <tr data-entry-id="{{ $mlog->id }}">
                                            <td style="text-align: center">{{ $mlog->id ?? '' }}</td>
                                            <td>{{ $mlog->boat->name ?? '' }}</td>
                                            <td>{{ $mlog->boat_namecomplete ?? '' }}</td>
                                            <td>{{ $mlog->wlist->description ?? '' }}</td>
                                            <td>{{ $mlog->date ?? '' }}</td>
                                            <td>{{ $mlog->employee->name ?? '' }}</td>
                                            <td>{{ $mlog->employee->email ?? '' }}</td>
                                            <td>{{ $mlog->item ?? '' }}</td>
                                            <td>{{ $mlog->product->name ?? '' }}</td>
                                            <td>{{ $mlog->description ?? '' }}</td>
                                            <td>
                                                @foreach($mlog->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ $mlog->units ?? '' }}</td>
                                            <td>{{ $mlog->price_unit ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $mlog->invoiced_line ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $mlog->invoiced_line ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $mlog->internal_notes ?? '' }}</td>
                                            <td>{{ $mlog->financial_document->reference_number ?? '' }}</td>
                                            <td>
                                                @if($mlog->financial_document)
                                                    {{ $mlog->financial_document::DOC_TYPE_RADIO[$mlog->financial_document->doc_type] ?? '' }}
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
            let table = $('.datatable-Mlog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            
        })
    </script>
@endsection