@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <a href="/home" class="btn btn-link text-white"><i class="fas fa-tachometer-alt"></i> Home</a>
                <a href="/clients" class="btn btn-link text-white"><i class="fa fa-users"></i> Clients</a>
                <a href="/marinas" class="btn btn-link text-white"><i class="fa fa-anchor"></i> Marinas</a>
                <a href="/wlists" class="btn btn-link text-white"><i class="fa fa-briefcase"></i> Works</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5><strong><i class="fas fa-anchor"></i> {{ strtoupper(trans('cruds.boat.title_singular')) }}
                                    {{ strtoupper(trans('global.list')) }}</strong></h5>
                            @can('boat_create')
                                <div>
                                    <a class="btn btn-success btn-sm mr-1" href="{{ route('frontend.boats.create') }}">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                        {{ trans('global.app_csvImport') }}
                                    </button>
                                    @include('csvImport.modal', [
                                        'model' => 'Boat',
                                        'route' => 'admin.boats.parseCsvImport',
                                    ])
                                </div>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Boat">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.boat.fields.name') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.boat.fields.mmsi') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.boat.fields.marina') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.boat.fields.clients') }}
                                            </th>
                                            <th>
                                                &nbsp;
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($boats as $key => $boat)
                                            <tr data-entry-id="{{ $boat->id }}">

                                                <td>
                                                    {{ $boat->boat_type ?? '' }} {{ $boat->name ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $boat->mmsi ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $boat->marina->name ?? '' }}
                                                </td>
                                                <td>
                                                    @foreach ($boat->clients as $key => $item)
                                                        <span>{{ $item->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @can('boat_show')
                                                        <a class="btn btn-xs btn-primary"
                                                            href="{{ route('frontend.boats.show', $boat->id) }}">
                                                            {{ trans('global.view') }}
                                                        </a>
                                                    @endcan

                                                    @can('boat_edit')
                                                        <a class="btn btn-xs btn-info"
                                                            href="{{ route('frontend.boats.edit', $boat->id) }}">
                                                            {{ trans('global.edit') }}
                                                        </a>
                                                    @endcan

                                                    @can('boat_delete')
                                                        <form action="{{ route('frontend.boats.destroy', $boat->id) }}"
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
                @can('boat_delete')
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('frontend.boats.massDestroy') }}",
                        className: 'btn-danger',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
                                return $(entry).data('entry-id')
                            });

                            if (ids.length === 0) {
                                alert('{{ trans('global.datatables.zero_selected') }}')

                                return
                            }

                            if (confirm('{{ trans('global.areYouSure') }}')) {
                                $.ajax({
                                        headers: {
                                            'x-csrf-token': _token
                                        },
                                        method: 'POST',
                                        url: config.url,
                                        data: {
                                            ids: ids,
                                            _method: 'DELETE'
                                        }
                                    })
                                    .done(function() {
                                        location.reload()
                                    })
                            }
                        }
                    }
                    dtButtons.push(deleteButton)
                @endcan

                $.extend(true, $.fn.dataTable.defaults, {
                    orderCellsTop: true,
                    order: [
                        [1, 'desc']
                    ],
                    pageLength: 100,
                });
                let table = $('.datatable-Boat:not(.ajaxTable)').DataTable({
                    buttons: dtButtons
                })
                $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });

                let visibleColumnsIndexes = null;
                $('.datatable thead').on('input', '.search', function() {
                    let strict = $(this).attr('strict') || false
                    let value = strict && this.value ? "^" + this.value + "$" : this.value

                    let index = $(this).parent().index()
                    if (visibleColumnsIndexes !== null) {
                        index = visibleColumnsIndexes[index]
                    }

                    table
                        .column(index)
                        .search(value, strict)
                        .draw()
                });
                table.on('column-visibility.dt', function(e, settings, column, state) {
                    visibleColumnsIndexes = []
                    table.columns(":visible").every(function(colIdx) {
                        visibleColumnsIndexes.push(colIdx);
                    });
                })
            })
        </script>
    @endsection
