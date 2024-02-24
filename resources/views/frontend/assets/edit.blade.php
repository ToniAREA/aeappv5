@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.asset.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $asset->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.asset.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $asset->description) !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.asset.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.photos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.asset.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $asset->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="available" value="0">
                                <input type="checkbox" name="available" id="available" value="1" {{ $asset->available || old('available', 0) === 1 ? 'checked' : '' }}>
                                <label for="available">{{ trans('cruds.asset.fields.available') }}</label>
                            </div>
                            @if($errors->has('available'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.available_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.asset.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $asset->location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="actual_holder_id">{{ trans('cruds.asset.fields.actual_holder') }}</label>
                            <select class="form-control select2" name="actual_holder_id" id="actual_holder_id">
                                @foreach($actual_holders as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('actual_holder_id') ? old('actual_holder_id') : $asset->actual_holder->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('actual_holder'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('actual_holder') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.actual_holder_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.asset.fields.notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes', $asset->notes) }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.asset.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $asset->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="data_1">{{ trans('cruds.asset.fields.data_1') }}</label>
                            <input class="form-control" type="text" name="data_1" id="data_1" value="{{ old('data_1', $asset->data_1) }}">
                            @if($errors->has('data_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('data_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.data_1_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="data_1_description">{{ trans('cruds.asset.fields.data_1_description') }}</label>
                            <input class="form-control" type="text" name="data_1_description" id="data_1_description" value="{{ old('data_1_description', $asset->data_1_description) }}">
                            @if($errors->has('data_1_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('data_1_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.data_1_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="data_2">{{ trans('cruds.asset.fields.data_2') }}</label>
                            <input class="form-control" type="text" name="data_2" id="data_2" value="{{ old('data_2', $asset->data_2) }}">
                            @if($errors->has('data_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('data_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.data_2_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="data_2_description">{{ trans('cruds.asset.fields.data_2_description') }}</label>
                            <input class="form-control" type="text" name="data_2_description" id="data_2_description" value="{{ old('data_2_description', $asset->data_2_description) }}">
                            @if($errors->has('data_2_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('data_2_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.data_2_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="files">{{ trans('cruds.asset.fields.files') }}</label>
                            <div class="needsclick dropzone" id="files-dropzone">
                            </div>
                            @if($errors->has('files'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('files') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.files_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a">{{ trans('cruds.asset.fields.link_a') }}</label>
                            <input class="form-control" type="text" name="link_a" id="link_a" value="{{ old('link_a', $asset->link_a) }}">
                            @if($errors->has('link_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.link_a_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a_description">{{ trans('cruds.asset.fields.link_a_description') }}</label>
                            <input class="form-control" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', $asset->link_a_description) }}">
                            @if($errors->has('link_a_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.link_a_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b">{{ trans('cruds.asset.fields.link_b') }}</label>
                            <input class="form-control" type="text" name="link_b" id="link_b" value="{{ old('link_b', $asset->link_b) }}">
                            @if($errors->has('link_b'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.link_b_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b_description">{{ trans('cruds.asset.fields.link_b_description') }}</label>
                            <input class="form-control" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', $asset->link_b_description) }}">
                            @if($errors->has('link_b_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.asset.fields.link_b_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_use">{{ trans('cruds.asset.fields.last_use') }}</label>
                            <input class="form-control datetime" type="text" name="last_use" id="last_use" value="{{ old('last_use', $asset->last_use) }}">
                            @if($errors->has('last_use'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_use') }}
                                </div>
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

        </div>
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
                xhr.open('POST', '{{ route('frontend.assets.storeCKEditorImages') }}', true);
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
    url: '{{ route('frontend.assets.storeMedia') }}',
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
    url: '{{ route('frontend.assets.storeMedia') }}',
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