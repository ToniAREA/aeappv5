@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.asset.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.asset.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.asset.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.asset.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.asset.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('available') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="available" value="0">
                    <input class="form-check-input" type="checkbox" name="available" id="available" value="1" {{ old('available', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="available">{{ trans('cruds.asset.fields.available') }}</label>
                </div>
                @if($errors->has('available'))
                    <span class="text-danger">{{ $errors->first('available') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.available_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.asset.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="actual_holder_id">{{ trans('cruds.asset.fields.actual_holder') }}</label>
                <select class="form-control select2 {{ $errors->has('actual_holder') ? 'is-invalid' : '' }}" name="actual_holder_id" id="actual_holder_id">
                    @foreach($actual_holders as $id => $entry)
                        <option value="{{ $id }}" {{ old('actual_holder_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('actual_holder'))
                    <span class="text-danger">{{ $errors->first('actual_holder') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.actual_holder_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.asset.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_1">{{ trans('cruds.asset.fields.data_1') }}</label>
                <input class="form-control {{ $errors->has('data_1') ? 'is-invalid' : '' }}" type="text" name="data_1" id="data_1" value="{{ old('data_1', '') }}">
                @if($errors->has('data_1'))
                    <span class="text-danger">{{ $errors->first('data_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.data_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_1_description">{{ trans('cruds.asset.fields.data_1_description') }}</label>
                <input class="form-control {{ $errors->has('data_1_description') ? 'is-invalid' : '' }}" type="text" name="data_1_description" id="data_1_description" value="{{ old('data_1_description', '') }}">
                @if($errors->has('data_1_description'))
                    <span class="text-danger">{{ $errors->first('data_1_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.data_1_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_2">{{ trans('cruds.asset.fields.data_2') }}</label>
                <input class="form-control {{ $errors->has('data_2') ? 'is-invalid' : '' }}" type="text" name="data_2" id="data_2" value="{{ old('data_2', '') }}">
                @if($errors->has('data_2'))
                    <span class="text-danger">{{ $errors->first('data_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.data_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_2_description">{{ trans('cruds.asset.fields.data_2_description') }}</label>
                <input class="form-control {{ $errors->has('data_2_description') ? 'is-invalid' : '' }}" type="text" name="data_2_description" id="data_2_description" value="{{ old('data_2_description', '') }}">
                @if($errors->has('data_2_description'))
                    <span class="text-danger">{{ $errors->first('data_2_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.data_2_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.asset.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a">{{ trans('cruds.asset.fields.link_a') }}</label>
                <input class="form-control {{ $errors->has('link_a') ? 'is-invalid' : '' }}" type="text" name="link_a" id="link_a" value="{{ old('link_a', '') }}">
                @if($errors->has('link_a'))
                    <span class="text-danger">{{ $errors->first('link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a_description">{{ trans('cruds.asset.fields.link_a_description') }}</label>
                <input class="form-control {{ $errors->has('link_a_description') ? 'is-invalid' : '' }}" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', '') }}">
                @if($errors->has('link_a_description'))
                    <span class="text-danger">{{ $errors->first('link_a_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.link_a_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b">{{ trans('cruds.asset.fields.link_b') }}</label>
                <input class="form-control {{ $errors->has('link_b') ? 'is-invalid' : '' }}" type="text" name="link_b" id="link_b" value="{{ old('link_b', '') }}">
                @if($errors->has('link_b'))
                    <span class="text-danger">{{ $errors->first('link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b_description">{{ trans('cruds.asset.fields.link_b_description') }}</label>
                <input class="form-control {{ $errors->has('link_b_description') ? 'is-invalid' : '' }}" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', '') }}">
                @if($errors->has('link_b_description'))
                    <span class="text-danger">{{ $errors->first('link_b_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.link_b_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_use">{{ trans('cruds.asset.fields.last_use') }}</label>
                <input class="form-control datetime {{ $errors->has('last_use') ? 'is-invalid' : '' }}" type="text" name="last_use" id="last_use" value="{{ old('last_use') }}">
                @if($errors->has('last_use'))
                    <span class="text-danger">{{ $errors->first('last_use') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.last_use_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.assets.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $asset->id ?? 0 }}');
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

<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.assets.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($asset) && $asset->photos)
          var files =
            {!! json_encode($asset->photos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.assets.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($asset) && $asset->files)
          var files =
            {!! json_encode($asset->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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