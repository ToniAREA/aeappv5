@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.toDo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.to-dos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="task">{{ trans('cruds.toDo.fields.task') }}</label>
                <input class="form-control {{ $errors->has('task') ? 'is-invalid' : '' }}" type="text" name="task" id="task" value="{{ old('task', '') }}">
                @if($errors->has('task'))
                    <span class="text-danger">{{ $errors->first('task') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.toDo.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes') !!}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_roles">{{ trans('cruds.toDo.fields.for_role') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('for_roles') ? 'is-invalid' : '' }}" name="for_roles[]" id="for_roles" multiple>
                    @foreach($for_roles as $id => $for_role)
                        <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_roles'))
                    <span class="text-danger">{{ $errors->first('for_roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.for_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_employee_id">{{ trans('cruds.toDo.fields.for_employee') }}</label>
                <select class="form-control select2 {{ $errors->has('for_employee') ? 'is-invalid' : '' }}" name="for_employee_id" id="for_employee_id">
                    @foreach($for_employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('for_employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_employee'))
                    <span class="text-danger">{{ $errors->first('for_employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.for_employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deadline">{{ trans('cruds.toDo.fields.deadline') }}</label>
                <input class="form-control date {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                @if($errors->has('deadline'))
                    <span class="text-danger">{{ $errors->first('deadline') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="priority">{{ trans('cruds.toDo.fields.priority') }}</label>
                <input class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" type="number" name="priority" id="priority" value="{{ old('priority', '') }}" step="1">
                @if($errors->has('priority'))
                    <span class="text-danger">{{ $errors->first('priority') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_repetitive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_repetitive" value="0">
                    <input class="form-check-input" type="checkbox" name="is_repetitive" id="is_repetitive" value="1" {{ old('is_repetitive', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_repetitive">{{ trans('cruds.toDo.fields.is_repetitive') }}</label>
                </div>
                @if($errors->has('is_repetitive'))
                    <span class="text-danger">{{ $errors->first('is_repetitive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.is_repetitive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="repeat_interval_value">{{ trans('cruds.toDo.fields.repeat_interval_value') }}</label>
                <input class="form-control {{ $errors->has('repeat_interval_value') ? 'is-invalid' : '' }}" type="number" name="repeat_interval_value" id="repeat_interval_value" value="{{ old('repeat_interval_value', '') }}" step="1">
                @if($errors->has('repeat_interval_value'))
                    <span class="text-danger">{{ $errors->first('repeat_interval_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.toDo.fields.repeat_interval_unit') }}</label>
                <select class="form-control {{ $errors->has('repeat_interval_unit') ? 'is-invalid' : '' }}" name="repeat_interval_unit" id="repeat_interval_unit">
                    <option value disabled {{ old('repeat_interval_unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('repeat_interval_unit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('repeat_interval_unit'))
                    <span class="text-danger">{{ $errors->first('repeat_interval_unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.toDo.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.toDo.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.toDo.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                @if($errors->has('completed_at'))
                    <span class="text-danger">{{ $errors->first('completed_at') }}</span>
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
                xhr.open('POST', '{{ route('admin.to-dos.storeCKEditorImages') }}', true);
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

@endsection