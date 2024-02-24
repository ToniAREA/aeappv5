@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.employeesSkill.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employees-skills.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">{{ trans('cruds.employeesSkill.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id">
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeesSkill.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subject_id">{{ trans('cruds.employeesSkill.fields.subject') }}</label>
                            <select class="form-control select2" name="subject_id" id="subject_id">
                                @foreach($subjects as $id => $entry)
                                    <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subject'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subject') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeesSkill.fields.subject_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="level">{{ trans('cruds.employeesSkill.fields.level') }}</label>
                            <input class="form-control" type="number" name="level" id="level" value="{{ old('level', '') }}" step="1">
                            @if($errors->has('level'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('level') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeesSkill.fields.level_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.employeesSkill.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeesSkill.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="verified" value="0">
                                <input type="checkbox" name="verified" id="verified" value="1" {{ old('verified', 0) == 1 ? 'checked' : '' }}>
                                <label for="verified">{{ trans('cruds.employeesSkill.fields.verified') }}</label>
                            </div>
                            @if($errors->has('verified'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('verified') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection