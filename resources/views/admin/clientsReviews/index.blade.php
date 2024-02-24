@extends('layouts.admin')
@section('content')
@can('clients_review_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.clients-reviews.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.clientsReview.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ClientsReview', 'route' => 'admin.clients-reviews.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.clientsReview.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ClientsReview">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.boats') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.proforma') }}
                        </th>
                        <th>
                            {{ trans('cruds.proforma.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.for_wlists') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.rating') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientsReview.fields.shown_online') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientsReviews as $key => $clientsReview)
                        <tr data-entry-id="{{ $clientsReview->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $clientsReview->id ?? '' }}
                            </td>
                            <td>
                                @foreach($clientsReview->boats as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $clientsReview->client->name ?? '' }}
                            </td>
                            <td>
                                {{ $clientsReview->client->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $clientsReview->proforma->proforma_number ?? '' }}
                            </td>
                            <td>
                                {{ $clientsReview->proforma->description ?? '' }}
                            </td>
                            <td>
                                @foreach($clientsReview->for_wlists as $key => $item)
                                    <span class="badge badge-info">{{ $item->deadline }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $clientsReview->rating ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $clientsReview->shown_online ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $clientsReview->shown_online ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('clients_review_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.clients-reviews.show', $clientsReview->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('clients_review_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.clients-reviews.edit', $clientsReview->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('clients_review_delete')
                                    <form action="{{ route('admin.clients-reviews.destroy', $clientsReview->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('clients_review_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clients-reviews.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ClientsReview:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection