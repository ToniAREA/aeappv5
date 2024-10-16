@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.iotSuscription.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.iot-suscriptions.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="user_id">{{ trans('cruds.iotSuscription.fields.user') }}</label>
                                <select class="form-control select2" name="user_id" id="user_id">
                                    @foreach ($users as $id => $entry)
                                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.user_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" id="is_active" value="1"
                                        {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                                    <label for="is_active">{{ trans('cruds.iotSuscription.fields.is_active') }}</label>
                                </div>
                                @if ($errors->has('is_active'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_active') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.is_active_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="client_id">{{ trans('cruds.iotSuscription.fields.client') }}</label>
                                <select class="form-control select2" name="client_id" id="client_id">
                                    @foreach ($clients as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('client'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.client_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="boats">{{ trans('cruds.iotSuscription.fields.boats') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="boats[]" id="boats" multiple>
                                    @foreach ($boats as $id => $boat)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('boats', [])) ? 'selected' : '' }}>{{ $boat }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('boats'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('boats') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.boats_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="plan_id">{{ trans('cruds.iotSuscription.fields.plan') }}</label>
                                <select class="form-control select2" name="plan_id" id="plan_id">
                                    @foreach ($plans as $id => $entry)
                                        <option value="{{ $id }}" {{ old('plan_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('plan'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('plan') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.plan_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="signed_contract">{{ trans('cruds.iotSuscription.fields.signed_contract') }}</label>
                                <div class="needsclick dropzone" id="signed_contract-dropzone">
                                </div>
                                @if ($errors->has('signed_contract'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('signed_contract') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.signed_contract_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="start_date">{{ trans('cruds.iotSuscription.fields.start_date') }}</label>
                                <input class="form-control date" type="text" name="start_date" id="start_date"
                                    value="{{ old('start_date') }}">
                                @if ($errors->has('start_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('start_date') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.start_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="end_date">{{ trans('cruds.iotSuscription.fields.end_date') }}</label>
                                <input class="form-control date" type="text" name="end_date" id="end_date"
                                    value="{{ old('end_date') }}">
                                @if ($errors->has('end_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('end_date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.end_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="hourly_rate">{{ trans('cruds.iotSuscription.fields.hourly_rate') }}</label>
                                <input class="form-control" type="number" name="hourly_rate" id="hourly_rate"
                                    value="{{ old('hourly_rate', '') }}" step="0.01">
                                @if ($errors->has('hourly_rate'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hourly_rate') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.hourly_rate_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="hourly_rate_discount">{{ trans('cruds.iotSuscription.fields.hourly_rate_discount') }}</label>
                                <input class="form-control" type="number" name="hourly_rate_discount"
                                    id="hourly_rate_discount" value="{{ old('hourly_rate_discount', '') }}" step="0.01">
                                @if ($errors->has('hourly_rate_discount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('hourly_rate_discount') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.hourly_rate_discount_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="material_discount">{{ trans('cruds.iotSuscription.fields.material_discount') }}</label>
                                <input class="form-control" type="number" name="material_discount"
                                    id="material_discount" value="{{ old('material_discount', '') }}" step="0.01">
                                @if ($errors->has('material_discount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('material_discount') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.material_discount_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="device_id">{{ trans('cruds.iotSuscription.fields.device') }}</label>
                                <select class="form-control select2" name="device_id" id="device_id">
                                    @foreach ($devices as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('device_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('device'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('device') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.device_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="link">{{ trans('cruds.iotSuscription.fields.link') }}</label>
                                <input class="form-control" type="text" name="link" id="link"
                                    value="{{ old('link', '') }}">
                                @if ($errors->has('link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.link_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="link_description">{{ trans('cruds.iotSuscription.fields.link_description') }}</label>
                                <input class="form-control" type="text" name="link_description" id="link_description"
                                    value="{{ old('link_description', '') }}">
                                @if ($errors->has('link_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.link_description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.iotSuscription.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', '') }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotSuscription.fields.notes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="internalnotes">{{ trans('cruds.iotSuscription.fields.internalnotes') }}</label>
                                <input class="form-control" type="text" name="internalnotes" id="internalnotes"
                                    value="{{ old('internalnotes', '') }}">
                                @if ($errors->has('internalnotes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('internalnotes') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.internalnotes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="completed_at">{{ trans('cruds.iotSuscription.fields.completed_at') }}</label>
                                <input class="form-control date" type="text" name="completed_at" id="completed_at"
                                    value="{{ old('completed_at') }}">
                                @if ($errors->has('completed_at'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('completed_at') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.completed_at_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="financial_document_id">{{ trans('cruds.iotSuscription.fields.financial_document') }}</label>
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
                                    class="help-block">{{ trans('cruds.iotSuscription.fields.financial_document_helper') }}</span>
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
        Dropzone.options.signedContractDropzone = {
            url: '{{ route('frontend.iot-suscriptions.storeMedia') }}',
            maxFilesize: 15, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 15
            },
            success: function(file, response) {
                $('form').find('input[name="signed_contract"]').remove()
                $('form').append('<input type="hidden" name="signed_contract" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="signed_contract"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($iotSuscription) && $iotSuscription->signed_contract)
                    var file = {!! json_encode($iotSuscription->signed_contract) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="signed_contract" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
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
