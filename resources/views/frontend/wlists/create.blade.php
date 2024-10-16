@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card" style="min-width: 60px; padding: 1px; margin: 1px; font-size: 14px;">
                    <div class="card-header">
                        {{ $boat->boat_type . ' ' . $boat->name }}: {{ trans('global.create') }}
                        {{ trans('cruds.wlist.title_singular') }}
                    </div>

                    <div class="card-body">
                        {{-- @php
                            dump(get_defined_vars());
                        @endphp --}}
                        <form method="POST" action="{{ route('frontend.wlists.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <!-- Campo oculto para boat_id -->
                            <input type="hidden" name="boat_id" value="{{ $boat_id }}">
                            {{-- Boat ID: {{ $boat_id }}<br> --}}


                            <!-- Campo oculto para from_user_id -->
                            <input type="hidden" name="from_user_id" value="{{ $from_user_id }}">
                            {{-- From User ID: {{ $from_user_id }}<br> --}}

                            <!-- Campo oculto para boat_namecomplete -->
                            <input type="hidden" name="boat_namecomplete"
                                value="{{ $boat->boat_type . ' ' . $boat->name }}">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="wlistTab" role="tablist">
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
                            <div class="tab-content mt-2" id="wlistTabContent">
                                <!-- First Tab -->
                                <div class="tab-pane fade show active" id="tab-general" role="tabpanel"
                                    aria-labelledby="tab-general-tab">
                                    <!-- Form fields for the first tab -->

                                    <div class="form-group">
                                        <label for="client_id">{{ trans('cruds.wlist.fields.client') }}</label><br>
                                        <select class="form-control select2" name="client_id" id="client_id">
                                            @foreach ($clients as $id => $entry)
                                                <option value="{{ $id }}"
                                                    {{ old('client_id', request('client_id')) == $id ? 'selected' : '' }}>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('client'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('client') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.wlist.fields.client_helper') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label class="required">{{ trans('cruds.wlist.fields.order_type') }}</label><br>
                                        <div class="btn-group btn-group-toggle d-flex justify-content-center"
                                            data-toggle="buttons">
                                            @foreach (App\Models\Wlist::ORDER_TYPE_RADIO as $key => $label)
                                                <label
                                                    class="btn btn-sm btn-primary flex-fill {{ old('order_type', 'request') === (string) $key ? 'active' : '' }}"
                                                    style="min-width: 60px; padding: 1px; margin: 1px; font-size: 12px;">
                                                    <input type="radio" name="order_type"
                                                        id="order_type_{{ $key }}" value="{{ $key }}"
                                                        {{ old('order_type', 'request') === (string) $key ? 'checked' : '' }}
                                                        required> {{ $label }}
                                                </label>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('order_type'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('order_type') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.wlist.fields.order_type_helper') }}</span>
                                    </div>

                                    <div class="form-row align-items-end">
                                        <div class="col col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="for_roles">{{ trans('cruds.wlist.fields.for_role') }}</label>
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
                                                            {{ in_array($id, old('for_roles', $default_role_ids ?? [])) ? 'selected' : '' }}>
                                                            {{ $for_role }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('for_roles'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('for_roles') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.for_role_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col col-12 col-sm-6">
                                            <div class="form-group">
                                                <label
                                                    for="for_employee_id">{{ trans('cruds.wlist.fields.for_employee') }}</label><br>
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
                                                    class="help-block">{{ trans('cruds.wlist.fields.for_employee_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="required"
                                            for="description">{{ trans('cruds.wlist.fields.description') }}</label>
                                        <textarea class="form-control" name="description" id="description" required minlength="5"></textarea>
                                        @if ($errors->has('description'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('description') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.wlist.fields.description_helper') }}</span>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label
                                                    for="estimated_hours">{{ trans('cruds.wlist.fields.estimated_hours') }}</label>
                                                <input class="form-control" type="number" name="estimated_hours"
                                                    id="estimated_hours" value="{{ old('estimated_hours', 4) }}"
                                                    step="0.01">
                                                @if ($errors->has('estimated_hours'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('estimated_hours') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.estimated_hours_helper') }}</span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="deadline">{{ trans('cruds.wlist.fields.deadline') }}</label>
                                                {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                                                <input class="form-control date" type="text" name="deadline"
                                                    id="deadline"
                                                    value="{{ old('deadline', \Carbon\Carbon::now()->addWeeks(2)->format('d-m-Y')) }}">
                                                @if ($errors->has('deadline'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('deadline') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.deadline_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row align-items-end">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="priority">{{ trans('cruds.wlist.fields.priority') }}</label>
                                                <output id="priorityOutput"
                                                    style="font-weight: bold; margin-left: 5px;">{{ old('priority', 5) }}</output>
                                                <input class="form-control" type="range" name="priority"
                                                    id="priority" value="{{ old('priority', 5) }}" min="0"
                                                    max="10" step="1">

                                                @if ($errors->has('priority'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('priority') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.priority_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="status_id">{{ trans('cruds.wlist.fields.status') }}</label>
                                                <select class="form-control select2" name="status_id" id="status_id">
                                                    @foreach ($statuses as $id => $entry)
                                                        <option value="{{ $id }}"
                                                            {{ old('status_id', 1) == $id ? 'selected' : '' }}>
                                                            {{ $entry }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('status'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.status_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('priority').addEventListener('input', function() {
                                            document.getElementById('priorityOutput').value = this.value;
                                        });
                                    </script>
                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <button class="btn btn-danger" type="submit" style="width: 300px;">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>

                                </div>
                                <!-- Second Tab -->

                                <div class="tab-pane fade" id="tab-details" role="tabpanel"
                                    aria-labelledby="tab-details-tab">
                                    <!-- Form fields for the second tab -->


                                    <div class="form-group">
                                        <label for="photos">{{ trans('cruds.wlist.fields.photos') }}</label>
                                        <div class="needsclick dropzone" id="photos-dropzone">
                                        </div>
                                        @if ($errors->has('photos'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('photos') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.wlist.fields.photos_helper') }}</span>
                                    </div>


                                    <div class="form-group">
                                        <label for="proforma_link">{{ trans('cruds.wlist.fields.proforma_link') }}</label>
                                        <input class="form-control" type="text" name="proforma_link"
                                            id="proforma_link" value="{{ old('proforma_link', '') }}">
                                        @if ($errors->has('proforma_link'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('proforma_link') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.wlist.fields.proforma_link_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">{{ trans('cruds.wlist.fields.notes') }}</label>
                                        <textarea class="form-control" name="notes" id="notes">{{ old('notes', '') }}</textarea>
                                        @if ($errors->has('notes'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('notes') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.wlist.fields.notes_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="internal_notes">{{ trans('cruds.wlist.fields.internal_notes') }}</label>
                                        <input class="form-control" type="text" name="internal_notes"
                                            id="internal_notes" value="{{ old('internal_notes', '') }}">
                                        @if ($errors->has('internal_notes'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('internal_notes') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.wlist.fields.internal_notes_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">{{ trans('cruds.wlist.fields.link') }}</label>
                                        <input class="form-control" type="text" name="link" id="link"
                                            value="{{ old('link', '') }}">
                                        @if ($errors->has('link'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('link') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.wlist.fields.link_helper') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="link_description">{{ trans('cruds.wlist.fields.link_description') }}</label>
                                        <input class="form-control" type="text" name="link_description"
                                            id="link_description" value="{{ old('link_description', '') }}">
                                        @if ($errors->has('link_description'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('link_description') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.wlist.fields.link_description_helper') }}</span>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="last_use">{{ trans('cruds.wlist.fields.last_use') }}</label>
                                                <input class="form-control datetime" type="text" name="last_use"
                                                    id="last_use"
                                                    value="{{ old('last_use', \Carbon\Carbon::now()->format('Y-m-d H:i:s')) }}">
                                                @if ($errors->has('last_use'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('last_use') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.last_use_helper') }}</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label
                                                    for="completed_at">{{ trans('cruds.wlist.fields.completed_at') }}</label>
                                                <input class="form-control datetime" type="text" name="completed_at"
                                                    id="completed_at" value="{{ old('completed_at') }}">
                                                @if ($errors->has('completed_at'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('completed_at') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.wlist.fields.completed_at_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="financial_document_id">{{ trans('cruds.wlist.fields.financial_document') }}</label><br>
                                        <select class="form-control select2" name="financial_document_id"
                                            id="financial_document_id">
                                            @foreach ($financial_documents as $id => $entry)
                                                <option value="{{ $id }}"
                                                    {{ old('financial_document_id') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('financial_document'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('financial_document') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.wlist.fields.financial_document_helper') }}</span>
                                    </div>

                                    <div class="form-group d-flex justify-content-center mt-3">
                                        <button class="btn btn-danger" type="submit" style="width: 300px;">
                                            {{ trans('global.save') }}
                                        </button>
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
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('frontend.wlists.storeMedia') }}',
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
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
            init: function() {
                @if (isset($wlist) && $wlist->photos)
                    var files = {!! json_encode($wlist->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
