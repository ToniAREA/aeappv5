@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.carePlan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.care-plans.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.carePlan.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="short_description">{{ trans('cruds.carePlan.fields.short_description') }}</label>
                            <input class="form-control" type="text" name="short_description" id="short_description" value="{{ old('short_description', '') }}">
                            @if($errors->has('short_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.short_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.carePlan.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="checkpoints">{{ trans('cruds.carePlan.fields.checkpoints') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="checkpoints[]" id="checkpoints" multiple required>
                                @foreach($checkpoints as $id => $checkpoint)
                                    <option value="{{ $id }}" {{ in_array($id, old('checkpoints', [])) ? 'selected' : '' }}>{{ $checkpoint }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('checkpoints'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('checkpoints') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.checkpoints_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.carePlan.fields.period') }}</label>
                            @foreach(App\Models\CarePlan::PERIOD_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', 'annually') === (string) $key ? 'checked' : '' }} required>
                                    <label for="period_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="period_price">{{ trans('cruds.carePlan.fields.period_price') }}</label>
                            <input class="form-control" type="number" name="period_price" id="period_price" value="{{ old('period_price', '') }}" step="0.01" required>
                            @if($errors->has('period_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.period_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="seo_title">{{ trans('cruds.carePlan.fields.seo_title') }}</label>
                            <input class="form-control" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', '') }}">
                            @if($errors->has('seo_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.seo_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="seo_meta_description">{{ trans('cruds.carePlan.fields.seo_meta_description') }}</label>
                            <input class="form-control" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', '') }}">
                            @if($errors->has('seo_meta_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_meta_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.carePlan.fields.seo_meta_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="seo_slug">{{ trans('cruds.carePlan.fields.seo_slug') }}</label>
                            <input class="form-control" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', '') }}">
                            @if($errors->has('seo_slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_slug') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection