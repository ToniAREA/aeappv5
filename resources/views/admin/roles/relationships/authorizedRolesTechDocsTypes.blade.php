<div class="m-3">
    @can('tech_docs_type_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tech-docs-types.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.techDocsType.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.techDocsType.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-authorizedRolesTechDocsTypes">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.techDocsType.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.techDocsType.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.techDocsType.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.techDocsType.fields.authorized_roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.techDocsType.fields.authorized_users') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($techDocsTypes as $key => $techDocsType)
                            <tr data-entry-id="{{ $techDocsType->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $techDocsType->id ?? '' }}
                                </td>
                                <td>
                                    {{ $techDocsType->name ?? '' }}
                                </td>
                                <td>
                                    {{ $techDocsType->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($techDocsType->authorized_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($techDocsType->authorized_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('tech_docs_type_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.tech-docs-types.show', $techDocsType->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('tech_docs_type_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.tech-docs-types.edit', $techDocsType->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('tech_docs_type_delete')
                                        <form action="{{ route('admin.tech-docs-types.destroy', $techDocsType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tech_docs_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tech-docs-types.massDestroy') }}",
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
  let table = $('.datatable-authorizedRolesTechDocsTypes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection