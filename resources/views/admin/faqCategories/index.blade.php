@extends('layouts.admin')
@section('content')
@can('faq_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.faq-categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.faqCategory.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FaqCategory', 'route' => 'admin.faq-categories.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.faqCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FaqCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.authorized_roles') }}
                        </th>
                        <th>
                            {{ trans('cruds.faqCategory.fields.authorized_users') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($roles as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqCategories as $key => $faqCategory)
                        <tr data-entry-id="{{ $faqCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $faqCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $faqCategory->category ?? '' }}
                            </td>
                            <td>
                                {{ $faqCategory->description ?? '' }}
                            </td>
                            <td>
                                @if($faqCategory->photo)
                                    <a href="{{ $faqCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $faqCategory->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($faqCategory->authorized_roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($faqCategory->authorized_users as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('faq_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.faq-categories.show', $faqCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('faq_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.faq-categories.edit', $faqCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('faq_category_delete')
                                    <form action="{{ route('admin.faq-categories.destroy', $faqCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('faq_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.faq-categories.massDestroy') }}",
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
  let table = $('.datatable-FaqCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection