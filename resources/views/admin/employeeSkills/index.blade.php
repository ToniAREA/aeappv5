@extends('layouts.admin')
@section('content')
@can('employee_skill_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employee-skills.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employeeSkill.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'EmployeeSkill', 'route' => 'admin.employee-skills.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeeSkill.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EmployeeSkill">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.subject') }}
                    </th>
                    <th>
                        {{ trans('cruds.skillsCategory.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.level') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeSkill.fields.verified') }}
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
@can('employee_skill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employee-skills.massDestroy') }}",
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
    ajax: "{{ route('admin.employee-skills.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'employee_id_employee', name: 'employee.id_employee' },
{ data: 'employee.namecomplete', name: 'employee.namecomplete' },
{ data: 'subject_subject', name: 'subject.subject' },
{ data: 'subject.description', name: 'subject.description' },
{ data: 'level', name: 'level' },
{ data: 'description', name: 'description' },
{ data: 'verified', name: 'verified' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EmployeeSkill').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection