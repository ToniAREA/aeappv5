@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employeeSkill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employee-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.id') }}
                        </th>
                        <td>
                            {{ $employeeSkill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.employee') }}
                        </th>
                        <td>
                            {{ $employeeSkill->employee->id_employee ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.subject') }}
                        </th>
                        <td>
                            {{ $employeeSkill->subject->subject ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.level') }}
                        </th>
                        <td>
                            {{ $employeeSkill->level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.description') }}
                        </th>
                        <td>
                            {{ $employeeSkill->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeeSkill.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $employeeSkill->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employee-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection