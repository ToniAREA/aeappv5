@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.plan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.plans.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="plan_name">{{ trans('cruds.plan.fields.plan_name') }}</label>
                            <input class="form-control" type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', '') }}">
                            @if($errors->has('plan_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plan_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.plan_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="show_online" value="0">
                                <input type="checkbox" name="show_online" id="show_online" value="1" {{ old('show_online', 0) == 1 ? 'checked' : '' }}>
                                <label for="show_online">{{ trans('cruds.plan.fields.show_online') }}</label>
                            </div>
                            @if($errors->has('show_online'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('show_online') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.show_online_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.plan.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="duration_months">{{ trans('cruds.plan.fields.duration_months') }}</label>
                            <input class="form-control" type="number" name="duration_months" id="duration_months" value="{{ old('duration_months', '') }}" step="1">
                            @if($errors->has('duration_months'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('duration_months') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.duration_months_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('cruds.plan.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="seo_title">{{ trans('cruds.plan.fields.seo_title') }}</label>
                            <input class="form-control" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', '') }}">
                            @if($errors->has('seo_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.seo_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="seo_meta_description">{{ trans('cruds.plan.fields.seo_meta_description') }}</label>
                            <input class="form-control" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', '') }}">
                            @if($errors->has('seo_meta_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_meta_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.seo_meta_description_helper') }}</span>
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