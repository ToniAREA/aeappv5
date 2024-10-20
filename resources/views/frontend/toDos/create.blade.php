@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card" style="min-width: 60px; padding: 1px; margin: 1px; font-size: 14px;">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.toDo.title_singular') }}
                    </div>

                    <div class="card-body">
                        {{-- @php
                            dump(get_defined_vars());
                        @endphp --}}
                        <form method="POST" action="{{ route('frontend.to-dos.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="toDoTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-general-tab" data-toggle="tab" href="#tab-general"
                                        role="tab" aria-controls="tab-general"
                                        aria-selected="true">{{ __('General') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-details-tab" data-toggle="tab" href="#tab-details"
                                        role="tab" aria-controls="tab-details"
                                        aria-selected="false">{{ __('Details') }}</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content mt-2" id="toDoTabContent">
                                <!-- Pestaña General -->
                                <div class="tab-pane fade show active" id="tab-general" role="tabpanel"
                                    aria-labelledby="tab-general-tab">
                                    <!-- Campos del formulario para la pestaña General -->

                                    <div class="form-group">
                                        <label for="task">{{ trans('cruds.toDo.fields.task') }}</label>
                                        <input class="form-control" type="text" name="task" id="task"
                                            value="{{ old('task', '') }}">
                                        @if ($errors->has('task'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('task') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.toDo.fields.task_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">{{ trans('cruds.toDo.fields.notes') }}</label>
                                        <textarea class="form-control ckeditor" name="notes" id="notes">{!! old('notes') !!}</textarea>
                                        @if ($errors->has('notes'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('notes') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.toDo.fields.notes_helper') }}</span>
                                    </div>

                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <button class="btn btn-danger" type="submit" style="width: 300px;">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>

                                </div>
                                <!-- Pestaña Detalles -->
                                <div class="tab-pane fade" id="tab-details" role="tabpanel"
                                    aria-labelledby="tab-details-tab">
                                    <!-- Campos del formulario para la pestaña Details -->

                                    <div class="form-row">
                                        <div class="col col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="for_roles">{{ trans('cruds.toDo.fields.for_role') }}</label>
                                                <div style="padding-bottom: 4px">
                                                    <span class="btn btn-info btn-xs select-all"
                                                        style="border-radius: 10">{{ trans('global.select_all') }}</span>
                                                    <span class="btn btn-info btn-xs deselect-all"
                                                        style="border-radius: 10">{{ trans('global.deselect_all') }}</span>
                                                </div>
                                                <select class="form-control select2" name="for_roles[]" id="for_roles"
                                                    multiple>
                                                    @foreach ($for_roles as $id => $for_role)
                                                        <option value="{{ $id }}"
                                                            {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>
                                                            {{ $for_role }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('for_roles'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('for_roles') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.for_role_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col col-12 col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="for_employee_id">{{ trans('cruds.toDo.fields.for_employee') }}</label>
                                                <select class="form-control select2" name="for_employee_id"
                                                    id="for_employee_id">
                                                    @foreach ($for_employees as $id => $entry)
                                                        <option value="{{ $id }}"
                                                            {{ old('for_employee_id') == $id ? 'selected' : '' }}>
                                                            {{ $entry }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('for_employee'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('for_employee') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.for_employee_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="deadline">{{ trans('cruds.toDo.fields.deadline') }}</label>
                                                <input class="form-control date" type="text" name="deadline"
                                                    id="deadline" value="{{ old('deadline') }}">
                                                @if ($errors->has('deadline'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('deadline') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="priority">{{ trans('cruds.toDo.fields.priority') }}</label>
                                                <output id="priorityOutput"
                                                    style="font-weight: bold; margin-left: 5px;">{{ old('priority', 5) }}</output>
                                                <input class="form-control" type="range" name="priority" id="priority"
                                                    value="{{ old('priority', 5) }}" min="0" max="10"
                                                    step="1">
                                                @if ($errors->has('priority'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('priority') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div>
                                            <input type="hidden" name="is_repetitive" value="0">
                                            <input type="checkbox" name="is_repetitive" id="is_repetitive"
                                                value="1" {{ old('is_repetitive', 0) == 1 ? 'checked' : '' }}>
                                            <label
                                                for="is_repetitive">{{ trans('cruds.toDo.fields.is_repetitive') }}</label>
                                        </div>
                                        @if ($errors->has('is_repetitive'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('is_repetitive') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.toDo.fields.is_repetitive_helper') }}</span>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label
                                                    for="repeat_interval_value">{{ trans('cruds.toDo.fields.repeat_interval_value') }}</label>
                                                <input class="form-control" type="number" name="repeat_interval_value"
                                                    id="repeat_interval_value"
                                                    value="{{ old('repeat_interval_value', '') }}" step="1">
                                                @if ($errors->has('repeat_interval_value'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('repeat_interval_value') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_value_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ trans('cruds.toDo.fields.repeat_interval_unit') }}</label>
                                                <select class="form-control" name="repeat_interval_unit"
                                                    id="repeat_interval_unit">
                                                    <option value disabled
                                                        {{ old('repeat_interval_unit', null) === null ? 'selected' : '' }}>
                                                        {{ trans('global.pleaseSelect') }}</option>
                                                    @foreach (App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT as $key => $label)
                                                        <option value="{{ $key }}"
                                                            {{ old('repeat_interval_unit', '') === (string) $key ? 'selected' : '' }}>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('repeat_interval_unit'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('repeat_interval_unit') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_unit_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            for="internal_notes">{{ trans('cruds.toDo.fields.internal_notes') }}</label>
                                        <input class="form-control" type="text" name="internal_notes"
                                            id="internal_notes" value="{{ old('internal_notes', '') }}">
                                        @if ($errors->has('internal_notes'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('internal_notes') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.toDo.fields.internal_notes_helper') }}</span>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="completed_at">{{ trans('cruds.toDo.fields.completed_at') }}</label>
                                        <input class="form-control datetime" type="text" name="completed_at"
                                            id="completed_at" value="{{ old('completed_at') }}">
                                        @if ($errors->has('completed_at'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('completed_at') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.toDo.fields.completed_at_helper') }}</span>
                                    </div> --}}

                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <button class="btn btn-danger" type="submit" style="width: 300px;">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>

                                </div>
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
        // Mostrar el valor actual del deslizador de prioridad
        document.getElementById('priority').addEventListener('input', function() {
            document.getElementById('priorityOutput').value = this.value;
        });
    </script>

    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Iniciar solicitud
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('frontend.to-dos.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Iniciar listeners
                                        var genericErrorText =
                                            `No se pudo subir el archivo: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Enviar solicitud
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
