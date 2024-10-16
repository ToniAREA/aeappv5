@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @can('employee_skill_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.employee-skills.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.employeeSkill.title_singular') }}
                            </a>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                {{ trans('global.app_csvImport') }}
                            </button>
                            @include('csvImport.modal', [
                                'model' => 'EmployeeSkill',
                                'route' => 'admin.employee-skills.parseCsvImport',
                            ])
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header">
                        {{ trans('cruds.employeeSkill.title_singular') }} {{ trans('global.list') }}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class=" table table-bordered table-striped table-hover datatable datatable-EmployeeSkill">
                                <thead>
                                    <tr>
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
                                            {{ trans('cruds.employeeSkill.fields.internal_notes') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeeSkills as $key => $employeeSkill)
                                        <tr data-entry-id="{{ $employeeSkill->id }}">
                                            <td>
                                                {{ $employeeSkill->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->employee->id_employee ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->employee->namecomplete ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->subject->subject ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->subject->description ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->level ?? '' }}
                                            </td>
                                            <td>
                                                {{ $employeeSkill->description ?? '' }}
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $employeeSkill->verified ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $employeeSkill->verified ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                {{ $employeeSkill->internal_notes ?? '' }}
                                            </td>
                                            <td>
                                                @can('employee_skill_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.employee-skills.show', $employeeSkill->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('employee_skill_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.employee-skills.edit', $employeeSkill->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('employee_skill_delete')
                                                    <form
                                                        action="{{ route('frontend.employee-skills.destroy', $employeeSkill->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                        style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="{{ trans('global.delete') }}">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('employee_skill_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.employee-skills.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-EmployeeSkill:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
