@extends('layouts.admin')
@section('content')
@can('skills_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.skills-categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.skillsCategory.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SkillsCategory', 'route' => 'admin.skills-categories.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.skillsCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SkillsCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.subject') }}
                        </th>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skillsCategories as $key => $skillsCategory)
                        <tr data-entry-id="{{ $skillsCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $skillsCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $skillsCategory->subject ?? '' }}
                            </td>
                            <td>
                                {{ $skillsCategory->description ?? '' }}
                            </td>
                            <td>
                                @if($skillsCategory->photo)
                                    <a href="{{ $skillsCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $skillsCategory->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('skills_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.skills-categories.show', $skillsCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('skills_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.skills-categories.edit', $skillsCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('skills_category_delete')
                                    <form action="{{ route('admin.skills-categories.destroy', $skillsCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('skills_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.skills-categories.massDestroy') }}",
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
  let table = $('.datatable-SkillsCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection