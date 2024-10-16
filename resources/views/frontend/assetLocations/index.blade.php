@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('asset_location_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.asset-locations.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.assetLocation.title_singular') }}
                            </a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                {{ trans('global.app_csvImport') }}
                            </button>
                            @include('csvImport.modal', [
                                'model' => 'AssetLocation',
                                'route' => 'admin.asset-locations.parseCsvImport',
                            ])
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.assetLocation.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class=" table table-bordered table-striped table-hover datatable datatable-AssetLocation">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetLocation.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.assetLocation.fields.is_available') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.assetLocation.fields.name') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.assetLocation.fields.description') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.assetLocation.fields.photo') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <input class="search" type="text"
                                                placeholder="{{ trans('global.search') }}">
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <input class="search" type="text"
                                                placeholder="{{ trans('global.search') }}">
                                        </td>
                                        <td>
                                            <input class="search" type="text"
                                                placeholder="{{ trans('global.search') }}">
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assetLocations as $key => $assetLocation)
                                        <tr data-entry-id="{{ $assetLocation->id }}">
                                            <td>
                                                {{ $assetLocation->id ?? '' }}
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $assetLocation->is_available ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $assetLocation->is_available ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                {{ $assetLocation->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $assetLocation->description ?? '' }}
                                            </td>
                                            <td>
                                                @if ($assetLocation->photo)
                                                    <a href="{{ $assetLocation->photo->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $assetLocation->photo->getUrl('thumb') }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @can('asset_location_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.asset-locations.show', $assetLocation->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('asset_location_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.asset-locations.edit', $assetLocation->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('asset_location_delete')
                                                    <form
                                                        action="{{ route('frontend.asset-locations.destroy', $assetLocation->id) }}"
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
            @can('asset_location_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.asset-locations.massDestroy') }}",
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
            let table = $('.datatable-AssetLocation:not(.ajaxTable)').DataTable({
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
