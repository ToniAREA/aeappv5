@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employeesSkill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.id') }}
                        </th>
                        <td>
                            {{ $employeesSkill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.employee') }}
                        </th>
                        <td>
                            {{ $employeesSkill->employee->id_employee ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.subject') }}
                        </th>
                        <td>
                            {{ $employeesSkill->subject->subject ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.level') }}
                        </th>
                        <td>
                            {{ $employeesSkill->level }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.description') }}
                        </th>
                        <td>
                            {{ $employeesSkill->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employeesSkill.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $employeesSkill->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees-skills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection