@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('employees_skill_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.employees-skills.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.employeesSkill.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.employeesSkill.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EmployeesSkill">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.namecomplete') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.subject') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.skillsCategory.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.level') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeesSkill.fields.verified') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeesSkills as $key => $employeesSkill)
                                    <tr data-entry-id="{{ $employeesSkill->id }}">
                                        <td>
                                            {{ $employeesSkill->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->employee->id_employee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->employee->namecomplete ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->subject->subject ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->subject->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->level ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeesSkill->description ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $employeesSkill->verified ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $employeesSkill->verified ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('employees_skill_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.employees-skills.show', $employeesSkill->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('employees_skill_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.employees-skills.edit', $employeesSkill->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('employees_skill_delete')
                                                <form action="{{ route('frontend.employees-skills.destroy', $employeesSkill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('employees_skill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.employees-skills.massDestroy') }}",
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
  let table = $('.datatable-EmployeesSkill:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection