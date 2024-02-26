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
                            <label class="required" for="short_description">{{ trans('cruds.plan.fields.short_description') }}</label>
                            <input class="form-control" type="text" name="short_description" id="short_description" value="{{ old('short_description', '') }}" required>
                            @if($errors->has('short_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.short_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.plan.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.description_helper') }}</span>
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
                            <label>{{ trans('cruds.plan.fields.period') }}</label>
                            @foreach(App\Models\Plan::PERIOD_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', 'biennially') === (string) $key ? 'checked' : '' }}>
                                    <label for="period_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="period_price">{{ trans('cruds.plan.fields.period_price') }}</label>
                            <input class="form-control" type="number" name="period_price" id="period_price" value="{{ old('period_price', '') }}" step="0.01" required>
                            @if($errors->has('period_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.period_price_helper') }}</span>
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
                            <label for="seo_slug">{{ trans('cruds.plan.fields.seo_slug') }}</label>
                            <input class="form-control" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', '') }}">
                            @if($errors->has('seo_slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('seo_slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.seo_slug_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contract">{{ trans('cruds.plan.fields.contract') }}</label>
                            <div class="needsclick dropzone" id="contract-dropzone">
                            </div>
                            @if($errors->has('contract'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contract') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.contract_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.plan.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.plan.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.plan.fields.link_description_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.contractDropzone = {
    url: '{{ route('frontend.plans.storeMedia') }}',
    maxFilesize: 15, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').find('input[name="contract"]').remove()
      $('form').append('<input type="hidden" name="contract" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="contract"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($plan) && $plan->contract)
      var file = {!! json_encode($plan->contract) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="contract" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection