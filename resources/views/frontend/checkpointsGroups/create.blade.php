@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.checkpointsGroup.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.checkpoints-groups.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_available" value="0">
                                    <input type="checkbox" name="is_available" id="is_available" value="1"
                                        {{ old('is_available', 0) == 1 ? 'checked' : '' }}>
                                    <label
                                        for="is_available">{{ trans('cruds.checkpointsGroup.fields.is_available') }}</label>
                                </div>
                                @if ($errors->has('is_available'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_available') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.checkpointsGroup.fields.is_available_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required"
                                    for="group">{{ trans('cruds.checkpointsGroup.fields.group') }}</label>
                                <input class="form-control" type="text" name="group" id="group"
                                    value="{{ old('group', '') }}" required>
                                @if ($errors->has('group'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('group') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.checkpointsGroup.fields.group_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.checkpointsGroup.fields.description') }}</label>
                                <input class="form-control" type="text" name="description" id="description"
                                    value="{{ old('description', '') }}">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.checkpointsGroup.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="photo">{{ trans('cruds.checkpointsGroup.fields.photo') }}</label>
                                <div class="needsclick dropzone" id="photo-dropzone">
                                </div>
                                @if ($errors->has('photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.checkpointsGroup.fields.photo_helper') }}</span>
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
        Dropzone.options.photoDropzone = {
            url: '{{ route('frontend.checkpoints-groups.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($checkpointsGroup) && $checkpointsGroup->photo)
                    var file = {!! json_encode($checkpointsGroup->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
