@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.plan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.plans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="plan_name">{{ trans('cruds.plan.fields.plan_name') }}</label>
                <input class="form-control {{ $errors->has('plan_name') ? 'is-invalid' : '' }}" type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', '') }}" required>
                @if($errors->has('plan_name'))
                    <span class="text-danger">{{ $errors->first('plan_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.plan_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_description">{{ trans('cruds.plan.fields.short_description') }}</label>
                <input class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" type="text" name="short_description" id="short_description" value="{{ old('short_description', '') }}" required>
                @if($errors->has('short_description'))
                    <span class="text-danger">{{ $errors->first('short_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.plan.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.plan.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ old('show_online', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.plan.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.show_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.plan.fields.period') }}</label>
                @foreach(App\Models\Plan::PERIOD_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('period') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', 'biennially') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="period_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('period'))
                    <span class="text-danger">{{ $errors->first('period') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.period_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="period_price">{{ trans('cruds.plan.fields.period_price') }}</label>
                <input class="form-control {{ $errors->has('period_price') ? 'is-invalid' : '' }}" type="number" name="period_price" id="period_price" value="{{ old('period_price', '') }}" step="0.01" required>
                @if($errors->has('period_price'))
                    <span class="text-danger">{{ $errors->first('period_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.period_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.plan.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', '') }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <span class="text-danger">{{ $errors->first('hourly_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate_discount">{{ trans('cruds.plan.fields.hourly_rate_discount') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate_discount') ? 'is-invalid' : '' }}" type="number" name="hourly_rate_discount" id="hourly_rate_discount" value="{{ old('hourly_rate_discount', '') }}" step="0.01">
                @if($errors->has('hourly_rate_discount'))
                    <span class="text-danger">{{ $errors->first('hourly_rate_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.hourly_rate_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="material_discount">{{ trans('cruds.plan.fields.material_discount') }}</label>
                <input class="form-control {{ $errors->has('material_discount') ? 'is-invalid' : '' }}" type="number" name="material_discount" id="material_discount" value="{{ old('material_discount', '') }}" step="0.01">
                @if($errors->has('material_discount'))
                    <span class="text-danger">{{ $errors->first('material_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.material_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract">{{ trans('cruds.plan.fields.contract') }}</label>
                <div class="needsclick dropzone {{ $errors->has('contract') ? 'is-invalid' : '' }}" id="contract-dropzone">
                </div>
                @if($errors->has('contract'))
                    <span class="text-danger">{{ $errors->first('contract') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.contract_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.plan.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.plan.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_title">{{ trans('cruds.plan.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', '') }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_meta_description">{{ trans('cruds.plan.fields.seo_meta_description') }}</label>
                <input class="form-control {{ $errors->has('seo_meta_description') ? 'is-invalid' : '' }}" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', '') }}">
                @if($errors->has('seo_meta_description'))
                    <span class="text-danger">{{ $errors->first('seo_meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.seo_meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_slug">{{ trans('cruds.plan.fields.seo_slug') }}</label>
                <input class="form-control {{ $errors->has('seo_slug') ? 'is-invalid' : '' }}" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', '') }}">
                @if($errors->has('seo_slug'))
                    <span class="text-danger">{{ $errors->first('seo_slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.plan.fields.seo_slug_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.plans.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($plan) && $plan->photo)
      var file = {!! json_encode($plan->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.contractDropzone = {
    url: '{{ route('admin.plans.storeMedia') }}',
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