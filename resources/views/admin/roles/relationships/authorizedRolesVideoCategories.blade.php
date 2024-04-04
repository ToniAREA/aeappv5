<div class="m-3">
    @can('video_category_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.video-categories.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.videoCategory.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.videoCategory.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-authorizedRolesVideoCategories">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.subject') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.authorized_roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.videoCategory.fields.authorized_users') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videoCategories as $key => $videoCategory)
                            <tr data-entry-id="{{ $videoCategory->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $videoCategory->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $videoCategory->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $videoCategory->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $videoCategory->subject ?? '' }}
                                </td>
                                <td>
                                    {{ $videoCategory->description ?? '' }}
                                </td>
                                <td>
                                    @if($videoCategory->photo)
                                        <a href="{{ $videoCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $videoCategory->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($videoCategory->authorized_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($videoCategory->authorized_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('video_category_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.video-categories.show', $videoCategory->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('video_category_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.video-categories.edit', $videoCategory->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('video_category_delete')
                                        <form action="{{ route('admin.video-categories.destroy', $videoCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('video_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.video-categories.massDestroy') }}",
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
  let table = $('.datatable-authorizedRolesVideoCategories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection