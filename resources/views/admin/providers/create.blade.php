@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.provider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.providers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.provider.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.provider.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.provider.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider_logo">{{ trans('cruds.provider.fields.provider_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('provider_logo') ? 'is-invalid' : '' }}" id="provider_logo-dropzone">
                </div>
                @if($errors->has('provider_logo'))
                    <span class="text-danger">{{ $errors->first('provider_logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.provider_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider_url">{{ trans('cruds.provider.fields.provider_url') }}</label>
                <input class="form-control {{ $errors->has('provider_url') ? 'is-invalid' : '' }}" type="text" name="provider_url" id="provider_url" value="{{ old('provider_url', '') }}">
                @if($errors->has('provider_url'))
                    <span class="text-danger">{{ $errors->first('provider_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.provider_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brands">{{ trans('cruds.provider.fields.brands') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('brands') ? 'is-invalid' : '' }}" name="brands[]" id="brands" multiple>
                    @foreach($brands as $id => $brand)
                        <option value="{{ $id }}" {{ in_array($id, old('brands', [])) ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>
                @if($errors->has('brands'))
                    <span class="text-danger">{{ $errors->first('brands') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.brands_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price_lists">{{ trans('cruds.provider.fields.price_lists') }}</label>
                <div class="needsclick dropzone {{ $errors->has('price_lists') ? 'is-invalid' : '' }}" id="price_lists-dropzone">
                </div>
                @if($errors->has('price_lists'))
                    <span class="text-danger">{{ $errors->first('price_lists') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.price_lists_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.provider.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.provider.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.provider.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.provider.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.provider.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.link_description_helper') }}</span>
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
    Dropzone.options.providerLogoDropzone = {
    url: '{{ route('admin.providers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="provider_logo"]').remove()
      $('form').append('<input type="hidden" name="provider_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="provider_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($provider) && $provider->provider_logo)
      var file = {!! json_encode($provider->provider_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="provider_logo" value="' + file.file_name + '">')
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
    var uploadedPriceListsMap = {}
Dropzone.options.priceListsDropzone = {
    url: '{{ route('admin.providers.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="price_lists[]" value="' + response.name + '">')
      uploadedPriceListsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPriceListsMap[file.name]
      }
      $('form').find('input[name="price_lists[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($provider) && $provider->price_lists)
          var files =
            {!! json_encode($provider->price_lists) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="price_lists[]" value="' + file.file_name + '">')
            }
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