@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeesSkill.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employees-skills.update", [$employeesSkill->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.employeesSkill.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employeesSkill->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeesSkill.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject_id">{{ trans('cruds.employeesSkill.fields.subject') }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject_id" id="subject_id">
                    @foreach($subjects as $id => $entry)
                        <option value="{{ $id }}" {{ (old('subject_id') ? old('subject_id') : $employeesSkill->subject->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeesSkill.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="level">{{ trans('cruds.employeesSkill.fields.level') }}</label>
                <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="number" name="level" id="level" value="{{ old('level', $employeesSkill->level) }}" step="1">
                @if($errors->has('level'))
                    <span class="text-danger">{{ $errors->first('level') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeesSkill.fields.level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.employeesSkill.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $employeesSkill->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeesSkill.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('verified') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="verified" value="0">
                    <input class="form-check-input" type="checkbox" name="verified" id="verified" value="1" {{ $employeesSkill->verified || old('verified', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="verified">{{ trans('cruds.employeesSkill.fields.verified') }}</label>
                </div>
                @if($errors->has('verified'))
                    <span class="text-danger">{{ $errors->first('verified') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeesSkill.fields.verified_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection