@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.brand.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.brands.update", [$brand->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_online" value="0">
                    <input class="form-check-input" type="checkbox" name="is_online" id="is_online" value="1" {{ $brand->is_online || old('is_online', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_online">{{ trans('cruds.brand.fields.is_online') }}</label>
                </div>
                @if($errors->has('is_online'))
                    <span class="text-danger">{{ $errors->first('is_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.is_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="brand">{{ trans('cruds.brand.fields.brand') }}</label>
                <input class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}" type="text" name="brand" id="brand" value="{{ old('brand', $brand->brand) }}" required>
                @if($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brand_logo">{{ trans('cruds.brand.fields.brand_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('brand_logo') ? 'is-invalid' : '' }}" id="brand_logo-dropzone">
                </div>
                @if($errors->has('brand_logo'))
                    <span class="text-danger">{{ $errors->first('brand_logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.brand_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brand_url">{{ trans('cruds.brand.fields.brand_url') }}</label>
                <input class="form-control {{ $errors->has('brand_url') ? 'is-invalid' : '' }}" type="text" name="brand_url" id="brand_url" value="{{ old('brand_url', $brand->brand_url) }}">
                @if($errors->has('brand_url'))
                    <span class="text-danger">{{ $errors->first('brand_url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.brand_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="providers">{{ trans('cruds.brand.fields.providers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('providers') ? 'is-invalid' : '' }}" name="providers[]" id="providers" multiple>
                    @foreach($providers as $id => $provider)
                        <option value="{{ $id }}" {{ (in_array($id, old('providers', [])) || $brand->providers->contains($id)) ? 'selected' : '' }}>{{ $provider }}</option>
                    @endforeach
                </select>
                @if($errors->has('providers'))
                    <span class="text-danger">{{ $errors->first('providers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.providers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.brand.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $brand->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.brand.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $brand->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.brand.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $brand->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.brand.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $brand->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.brand.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', $brand->link_description) }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.link_description_helper') }}</span>
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
    Dropzone.options.brandLogoDropzone = {
    url: '{{ route('admin.brands.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="brand_logo"]').remove()
      $('form').append('<input type="hidden" name="brand_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="brand_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($brand) && $brand->brand_logo)
      var file = {!! json_encode($brand->brand_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="brand_logo" value="' + file.file_name + '">')
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.brands.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $brand->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection