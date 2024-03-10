@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.carePlan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.care-plans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.carePlan.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_description">{{ trans('cruds.carePlan.fields.short_description') }}</label>
                <input class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" type="text" name="short_description" id="short_description" value="{{ old('short_description', '') }}">
                @if($errors->has('short_description'))
                    <span class="text-danger">{{ $errors->first('short_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.carePlan.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="checkpoints">{{ trans('cruds.carePlan.fields.checkpoints') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('checkpoints') ? 'is-invalid' : '' }}" name="checkpoints[]" id="checkpoints" multiple required>
                    @foreach($checkpoints as $id => $checkpoint)
                        <option value="{{ $id }}" {{ in_array($id, old('checkpoints', [])) ? 'selected' : '' }}>{{ $checkpoint }}</option>
                    @endforeach
                </select>
                @if($errors->has('checkpoints'))
                    <span class="text-danger">{{ $errors->first('checkpoints') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.checkpoints_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.carePlan.fields.period') }}</label>
                @foreach(App\Models\CarePlan::PERIOD_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('period') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', 'annually') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="period_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('period'))
                    <span class="text-danger">{{ $errors->first('period') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.period_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="period_price">{{ trans('cruds.carePlan.fields.period_price') }}</label>
                <input class="form-control {{ $errors->has('period_price') ? 'is-invalid' : '' }}" type="number" name="period_price" id="period_price" value="{{ old('period_price', '') }}" step="0.01" required>
                @if($errors->has('period_price'))
                    <span class="text-danger">{{ $errors->first('period_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.period_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_title">{{ trans('cruds.carePlan.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', '') }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_meta_description">{{ trans('cruds.carePlan.fields.seo_meta_description') }}</label>
                <input class="form-control {{ $errors->has('seo_meta_description') ? 'is-invalid' : '' }}" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', '') }}">
                @if($errors->has('seo_meta_description'))
                    <span class="text-danger">{{ $errors->first('seo_meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.seo_meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_slug">{{ trans('cruds.carePlan.fields.seo_slug') }}</label>
                <input class="form-control {{ $errors->has('seo_slug') ? 'is-invalid' : '' }}" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', '') }}">
                @if($errors->has('seo_slug'))
                    <span class="text-danger">{{ $errors->first('seo_slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carePlan.fields.seo_slug_helper') }}</span>
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