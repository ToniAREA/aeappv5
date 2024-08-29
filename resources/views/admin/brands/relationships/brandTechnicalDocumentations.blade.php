<div class="m-3">
    @can('technical_documentation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.technical-documentations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.technicalDocumentation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.technicalDocumentation.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-brandTechnicalDocumentations">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.file') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.doc_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.brand') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.image') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.seo_title') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.seo_meta_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.seo_slug') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.authorized_roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.technicalDocumentation.fields.authorized_users') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technicalDocumentations as $key => $technicalDocumentation)
                            <tr data-entry-id="{{ $technicalDocumentation->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $technicalDocumentation->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $technicalDocumentation->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $technicalDocumentation->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $technicalDocumentation->title ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->description ?? '' }}
                                </td>
                                <td>
                                    @if($technicalDocumentation->file)
                                        <a href="{{ $technicalDocumentation->file->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $technicalDocumentation->doc_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->brand->brand ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->product->model ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->product->name ?? '' }}
                                </td>
                                <td>
                                    @if($technicalDocumentation->image)
                                        <a href="{{ $technicalDocumentation->image->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $technicalDocumentation->image->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $technicalDocumentation->seo_title ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->seo_meta_description ?? '' }}
                                </td>
                                <td>
                                    {{ $technicalDocumentation->seo_slug ?? '' }}
                                </td>
                                <td>
                                    @foreach($technicalDocumentation->authorized_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($technicalDocumentation->authorized_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('technical_documentation_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.technical-documentations.show', $technicalDocumentation->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('technical_documentation_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.technical-documentations.edit', $technicalDocumentation->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('technical_documentation_delete')
                                        <form action="{{ route('admin.technical-documentations.destroy', $technicalDocumentation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('technical_documentation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.technical-documentations.massDestroy') }}",
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
  let table = $('.datatable-brandTechnicalDocumentations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection