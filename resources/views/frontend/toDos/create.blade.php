@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.toDo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.to-dos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="task">{{ trans('cruds.toDo.fields.task') }}</label>
                            <input class="form-control" type="text" name="task" id="task" value="{{ old('task', '') }}">
                            @if($errors->has('task'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('task') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.task_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.toDo.fields.notes') }}</label>
                            <textarea class="form-control ckeditor" name="notes" id="notes">{!! old('notes') !!}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.toDo.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.photos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_roles">{{ trans('cruds.toDo.fields.for_role') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_roles[]" id="for_roles" multiple>
                                @foreach($for_roles as $id => $for_role)
                                    <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.for_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_employee_id">{{ trans('cruds.toDo.fields.for_employee') }}</label>
                            <select class="form-control select2" name="for_employee_id" id="for_employee_id">
                                @foreach($for_employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('for_employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.for_employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="deadline">{{ trans('cruds.toDo.fields.deadline') }}</label>
                            <input class="form-control date" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                            @if($errors->has('deadline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deadline') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ trans('cruds.toDo.fields.priority') }}</label>
                            <input class="form-control" type="number" name="priority" id="priority" value="{{ old('priority', '') }}" step="1">
                            @if($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_repetitive" value="0">
                                <input type="checkbox" name="is_repetitive" id="is_repetitive" value="1" {{ old('is_repetitive', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_repetitive">{{ trans('cruds.toDo.fields.is_repetitive') }}</label>
                            </div>
                            @if($errors->has('is_repetitive'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_repetitive') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.is_repetitive_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="repeat_interval_value">{{ trans('cruds.toDo.fields.repeat_interval_value') }}</label>
                            <input class="form-control" type="number" name="repeat_interval_value" id="repeat_interval_value" value="{{ old('repeat_interval_value', '') }}" step="1">
                            @if($errors->has('repeat_interval_value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('repeat_interval_value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_value_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.toDo.fields.repeat_interval_unit') }}</label>
                            <select class="form-control" name="repeat_interval_unit" id="repeat_interval_unit">
                                <option value disabled {{ old('repeat_interval_unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('repeat_interval_unit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('repeat_interval_unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('repeat_interval_unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.toDo.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.toDo.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.toDo.fields.completed_at_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.to-dos.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $toDo->id ?? 0 }}');
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
    url: '{{ route('frontend.to-dos.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
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
@if(isset($toDo) && $toDo->photos)
      var files = {!! json_encode($toDo->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
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
@endsection