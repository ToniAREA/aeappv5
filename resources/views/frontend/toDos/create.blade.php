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
                        <form method="POST" action="{{ route('frontend.to-dos.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <div class="form-group">{{-- Task title --}}
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

                            <div class="form-group">{{-- Task description --}}
                                <label for="notes">{{ trans('cruds.toDo.fields.notes') }}</label>
                                <textarea class="form-control ckeditor" name="notes" id="notes">{!! old('notes') !!}</textarea>
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.toDo.fields.notes_helper') }}</span>
                            </div>
                            <div class="form-group">{{-- Internal notes --}}
                                <label for="internal_notes">{{ trans('cruds.toDo.fields.internal_notes') }}</label>
                                <input class="form-control" type="text" name="internal_notes" id="internal_notes"
                                    value="{{ old('internal_notes', '') }}">
                                @if ($errors->has('internal_notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('internal_notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.toDo.fields.internal_notes_helper') }}</span>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-6 col-sm-6 col-lg-3">{{-- For role --}}
                                    <div class="form-group">
                                        <label for="for_roles">{{ trans('cruds.toDo.fields.for_role') }}</label>
                                        <div style="padding-bottom: 4px">
                                            <span class="btn btn-info btn-xs select-all"
                                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                            <span class="btn btn-info btn-xs deselect-all"
                                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                        </div>


                                        <select class="form-control select2" name="for_roles[]" id="for_roles" multiple>
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

                                        <span class="help-block">{{ trans('cruds.toDo.fields.for_role_helper') }}</span>
                                    </div>
                                </div>

                                <div class="col-6 col-sm-6 col-lg-3">{{-- For employee --}}
                                    <div class="form-group">
                                        <label
                                            for="for_employee_id">{{ trans('cruds.toDo.fields.for_employee') }}</label><br>
                                        <select class="form-control select2" name="for_employee_id" id="for_employee_id">
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

                                <div class="col-12 col-sm-6 col-lg-3">{{-- Deadline --}}
                                    <div class="form-group">
                                        <label for="deadline">{{ trans('cruds.toDo.fields.deadline') }}</label>
                                        <input class="form-control date" type="text" name="deadline" id="deadline"
                                            value="{{ old('deadline') }}">
                                        @if ($errors->has('deadline'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('deadline') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.toDo.fields.deadline_helper') }}</span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">{{-- Priority --}}
                                    <div class="form-group">
                                        <label for="priority">{{ trans('cruds.toDo.fields.priority') }}</label> <span
                                            id="priorityValue">{{ old('priority', '') }}</span>
                                        <input class="form-control" type="range" name="priority" id="priority"
                                            value="{{ old('priority', '') }}"  value="5" min="1" max="10" step="1">
                                        @if ($errors->has('priority'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('priority') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.toDo.fields.priority_helper') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12 col-sm-3 col-lg-3">
                                    <div class="form-group">{{-- Is repetitive? --}}
                                        <div>
                                            <input type="hidden" name="is_repetitive" value="0">
                                            <input type="checkbox" name="is_repetitive" id="is_repetitive" value="1"
                                                {{ old('is_repetitive', 0) == 1 ? 'checked' : '' }}>
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
                                </div>

                                <div class="col-5 col-sm-4 col-lg-3">
                                    <div class="form-group">{{-- Repeat interval --}}
                                        <label
                                            for="repeat_interval_value">{{ trans('cruds.toDo.fields.repeat_interval_value') }}</label>
                                        <input class="form-control" type="number" name="repeat_interval_value"
                                            id="repeat_interval_value" value="{{ old('repeat_interval_value', '') }}"
                                            step="1">
                                        @if ($errors->has('repeat_interval_value'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('repeat_interval_value') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.toDo.fields.repeat_interval_value_helper') }}</span>
                                    </div>
                                </div>

                                <div class="col-7 col-sm-5 col-lg-3">
                                    <div class="form-group">{{-- Repeat interval unit --}}
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



                            @if ($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <hr class="mb-4">

                            <button class="btn btn-primary btn-block" type="submit">
                                {{ trans('global.save') }}
                            </button>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('frontend.to-dos.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
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
        // Obtiene el slider y el span donde se mostrará el valor
        var slider = document.getElementById("priority");
        var output = document.getElementById("priorityValue");

        // Actualiza el texto del span con el valor actual del slider
        output.innerHTML = slider.value;

        // Añade un event listener al slider para cambiar el valor del span cada vez que se mueva el slider
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>
@endsection
