<div class="m-3">
    @can('asset_category_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.asset-categories.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.assetCategory.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.assetCategory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-authorizedRolesAssetCategories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.authorized_roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.authorized_users') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetCategory.fields.photo') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assetCategories as $key => $assetCategory)
                            <tr data-entry-id="{{ $assetCategory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $assetCategory->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $assetCategory->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $assetCategory->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $assetCategory->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assetCategory->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($assetCategory->authorized_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($assetCategory->authorized_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($assetCategory->photo)
                                        <a href="{{ $assetCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $assetCategory->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('asset_category_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.asset-categories.show', $assetCategory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('asset_category_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.asset-categories.edit', $assetCategory->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('asset_category_delete')
                                        <form action="{{ route('admin.asset-categories.destroy', $assetCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('asset_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.asset-categories.massDestroy') }}",
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
  let table = $('.datatable-authorizedRolesAssetCategories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection