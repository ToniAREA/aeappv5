@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('assets_history_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assets-histories.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.assetsHistory.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'AssetsHistory', 'route' => 'admin.assets-histories.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.assetsHistory.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AssetsHistory">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.asset') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.assigned_user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.assetsHistory.fields.created_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assetsHistories as $key => $assetsHistory)
                                    <tr data-entry-id="{{ $assetsHistory->id }}">
                                        <td>
                                            {{ $assetsHistory->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->asset->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->status->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->assigned_user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $assetsHistory->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('assets_history_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assets-histories.show', $assetsHistory->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('assets_history_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.assets-histories.edit', $assetsHistory->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('assets_history_delete')
                                                <form action="{{ route('frontend.assets-histories.destroy', $assetsHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('assets_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assets-histories.massDestroy') }}",
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
  let table = $('.datatable-AssetsHistory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection