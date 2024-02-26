@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('documentation_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.documentations.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.documentation.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.documentation.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Documentation">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.documentation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentationCategory.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.expiration_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.is_valid') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.file') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.link') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.documentation.fields.link_description') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentations as $key => $documentation)
                                    <tr data-entry-id="{{ $documentation->id }}">
                                        <td>
                                            {{ $documentation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->category->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->expiration_date ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $documentation->is_valid ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $documentation->is_valid ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @if($documentation->file)
                                                <a href="{{ $documentation->file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $documentation->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documentation->link_description ?? '' }}
                                        </td>
                                        <td>
                                            @can('documentation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.documentations.show', $documentation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('documentation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.documentations.edit', $documentation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('documentation_delete')
                                                <form action="{{ route('frontend.documentations.destroy', $documentation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('documentation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.documentations.massDestroy') }}",
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
  let table = $('.datatable-Documentation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection