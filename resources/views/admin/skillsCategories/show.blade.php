@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.skillsCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.skills-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $skillsCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.subject') }}
                        </th>
                        <td>
                            {{ $skillsCategory->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.skillsCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $skillsCategory->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.skills-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#subject_employees_skills" role="tab" data-toggle="tab">
                {{ trans('cruds.employeesSkill.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subject_employees_skills">
            @includeIf('admin.skillsCategories.relationships.subjectEmployeesSkills', ['employeesSkills' => $skillsCategory->subjectEmployeesSkills])
        </div>
    </div>
</div>

@endsection