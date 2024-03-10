@extends('layouts.admin')
@section('content')
@can('video_tutorial_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.video-tutorials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.videoTutorial.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'VideoTutorial', 'route' => 'admin.video-tutorials.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.videoTutorial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-VideoTutorial">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.show_online') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.video_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.subjects') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.seo_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.seo_meta_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.seo_slug') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.authorized_roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.videoTutorial.fields.authorized_users') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
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
@can('video_tutorial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.video-tutorials.massDestroy') }}",
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
    ajax: "{{ route('admin.video-tutorials.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'show_online', name: 'show_online' },
{ data: 'description', name: 'description' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'video_url', name: 'video_url' },
{ data: 'subjects', name: 'subjects.subject' },
{ data: 'seo_title', name: 'seo_title' },
{ data: 'seo_meta_description', name: 'seo_meta_description' },
{ data: 'seo_slug', name: 'seo_slug' },
{ data: 'authorized_roles', name: 'authorized_roles.title' },
{ data: 'authorized_users', name: 'authorized_users.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-VideoTutorial').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection