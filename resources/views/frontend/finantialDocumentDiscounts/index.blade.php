@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('finantial_document_discount_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.finantial-document-discounts.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.finantialDocumentDiscount.title_singular') }}
                            </a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                {{ trans('global.app_csvImport') }}
                            </button>
                            @include('csvImport.modal', [
                                'model' => 'FinantialDocumentDiscount',
                                'route' => 'admin.finantial-document-discounts.parseCsvImport',
                            ])
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.finantialDocumentDiscount.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class=" table table-bordered table-striped table-hover datatable datatable-FinantialDocumentDiscount">
                                <thead>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentDiscount.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.finantialDocumentDiscount.fields.item') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.financialDocumentItem.fields.subtotal') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.finantialDocumentDiscount.fields.type') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.finantialDocumentDiscount.fields.discount_rate') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.finantialDocumentDiscount.fields.discount_amount') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finantialDocumentDiscounts as $key => $finantialDocumentDiscount)
                                        <tr data-entry-id="{{ $finantialDocumentDiscount->id }}">
                                            <td>
                                                {{ $finantialDocumentDiscount->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $finantialDocumentDiscount->item->description ?? '' }}
                                            </td>
                                            <td>
                                                {{ $finantialDocumentDiscount->item->subtotal ?? '' }}
                                            </td>
                                            <td>
                                                {{ $finantialDocumentDiscount->type ?? '' }}
                                            </td>
                                            <td>
                                                {{ $finantialDocumentDiscount->discount_rate ?? '' }}
                                            </td>
                                            <td>
                                                {{ $finantialDocumentDiscount->discount_amount ?? '' }}
                                            </td>
                                            <td>
                                                @can('finantial_document_discount_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.finantial-document-discounts.show', $finantialDocumentDiscount->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('finantial_document_discount_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.finantial-document-discounts.edit', $finantialDocumentDiscount->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('finantial_document_discount_delete')
                                                    <form
                                                        action="{{ route('frontend.finantial-document-discounts.destroy', $finantialDocumentDiscount->id) }}"
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
            @can('finantial_document_discount_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.finantial-document-discounts.massDestroy') }}",
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
            let table = $('.datatable-FinantialDocumentDiscount:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
