@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.income.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incomes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_accounted') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_accounted" value="0">
                    <input class="form-check-input" type="checkbox" name="is_accounted" id="is_accounted" value="1" {{ old('is_accounted', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_accounted">{{ trans('cruds.income.fields.is_accounted') }}</label>
                </div>
                @if($errors->has('is_accounted'))
                    <span class="text-danger">{{ $errors->first('is_accounted') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.is_accounted_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.income.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                <select class="form-control select2 {{ $errors->has('income_category') ? 'is-invalid' : '' }}" name="income_category_id" id="income_category_id">
                    @foreach($income_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('income_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('income_category'))
                    <span class="text-danger">{{ $errors->first('income_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.income_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entry_date">{{ trans('cruds.income.fields.entry_date') }}</label>
                <input class="form-control date {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required>
                @if($errors->has('entry_date'))
                    <span class="text-danger">{{ $errors->first('entry_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
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