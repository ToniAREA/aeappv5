@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.plan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.plans.update", [$plan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="plan_name">{{ trans('cruds.plan.fields.plan_name') }}</label>
                <input class="form-control {{ $errors->has('plan_name') ? 'is-invalid' : '' }}" type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', $plan->plan_name) }}">
                @if($errors->has('plan_name'))
                    <span class="text-danger">{{ $errors->first('plan_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.plan_name_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ $plan->show_online || old('show_online', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.plan.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.show_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.plan.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $plan->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration_months">{{ trans('cruds.plan.fields.duration_months') }}</label>
                <input class="form-control {{ $errors->has('duration_months') ? 'is-invalid' : '' }}" type="number" name="duration_months" id="duration_months" value="{{ old('duration_months', $plan->duration_months) }}" step="1">
                @if($errors->has('duration_months'))
                    <span class="text-danger">{{ $errors->first('duration_months') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.duration_months_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.plan.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $plan->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_title">{{ trans('cruds.plan.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $plan->seo_title) }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_meta_description">{{ trans('cruds.plan.fields.seo_meta_description') }}</label>
                <input class="form-control {{ $errors->has('seo_meta_description') ? 'is-invalid' : '' }}" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', $plan->seo_meta_description) }}">
                @if($errors->has('seo_meta_description'))
                    <span class="text-danger">{{ $errors->first('seo_meta_description') }}</span>
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



@endsection