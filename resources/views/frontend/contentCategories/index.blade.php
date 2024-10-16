@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('content_category_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.content-categories.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.contentCategory.title_singular') }}
                            </a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                {{ trans('global.app_csvImport') }}
                            </button>
                            @include('csvImport.modal', [
                                'model' => 'ContentCategory',
                                'route' => 'admin.content-categories.parseCsvImport',
                            ])
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.contentCategory.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class=" table table-bordered table-striped table-hover datatable datatable-ContentCategory">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.is_online') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.name') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.slug') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.photo') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.authorized_roles') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.authorized_users') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contentCategories as $key => $contentCategory)
                                        <tr data-entry-id="{{ $contentCategory->id }}">
                                            <td>
                                                {{ $contentCategory->id ?? '' }}
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $contentCategory->is_online ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $contentCategory->is_online ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                {{ $contentCategory->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ $contentCategory->slug ?? '' }}
                                            </td>
                                            <td>
                                                @if ($contentCategory->photo)
                                                    <a href="{{ $contentCategory->photo->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $contentCategory->photo->getUrl('thumb') }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @foreach ($contentCategory->authorized_roles as $key => $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($contentCategory->authorized_users as $key => $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('content_category_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.content-categories.show', $contentCategory->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('content_category_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.content-categories.edit', $contentCategory->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('content_category_delete')
                                                    <form
                                                        action="{{ route('frontend.content-categories.destroy', $contentCategory->id) }}"
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
            @can('content_category_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.content-categories.massDestroy') }}",
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
            let table = $('.datatable-ContentCategory:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
