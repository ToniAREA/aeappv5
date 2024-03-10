@extends('layouts.admin')
@section('content')
@can('content_page_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.content-pages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ContentPage', 'route' => 'admin.content-pages.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contentPage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ContentPage">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.show_online') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.slug') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.tag') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.featured_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.file') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.seo_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.seo_meta_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.seo_slug') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.link_a') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.link_a_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.show_online_link_a') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.link_b') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.link_b_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.show_online_link_b') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.view_count') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.authorized_roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.contentPage.fields.authorized_users') }}
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
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($content_categories as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($content_tags as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('content_page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.content-pages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.content-pages.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'show_online', name: 'show_online' },
{ data: 'slug', name: 'slug' },
{ data: 'category', name: 'categories.name' },
{ data: 'tag', name: 'tags.name' },
{ data: 'featured_image', name: 'featured_image', sortable: false, searchable: false },
{ data: 'file', name: 'file', sortable: false, searchable: false },
{ data: 'seo_title', name: 'seo_title' },
{ data: 'seo_meta_description', name: 'seo_meta_description' },
{ data: 'seo_slug', name: 'seo_slug' },
{ data: 'link_a', name: 'link_a' },
{ data: 'link_a_description', name: 'link_a_description' },
{ data: 'show_online_link_a', name: 'show_online_link_a' },
{ data: 'link_b', name: 'link_b' },
{ data: 'link_b_description', name: 'link_b_description' },
{ data: 'show_online_link_b', name: 'show_online_link_b' },
{ data: 'view_count', name: 'view_count' },
{ data: 'authorized_roles', name: 'authorized_roles.title' },
{ data: 'authorized_users', name: 'authorized_users.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ContentPage').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection