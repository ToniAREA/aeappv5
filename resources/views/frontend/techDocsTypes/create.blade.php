@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.techDocsType.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.tech-docs-types.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_online" value="0">
                                    <input type="checkbox" name="is_online" id="is_online" value="1"
                                        {{ old('is_online', 0) == 1 ? 'checked' : '' }}>
                                    <label for="is_online">{{ trans('cruds.techDocsType.fields.is_online') }}</label>
                                </div>
                                @if ($errors->has('is_online'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_online') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.techDocsType.fields.is_online_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('cruds.techDocsType.fields.name') }}</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name', '') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.techDocsType.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="photo">{{ trans('cruds.techDocsType.fields.photo') }}</label>
                                <div class="needsclick dropzone" id="photo-dropzone">
                                </div>
                                @if ($errors->has('photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.techDocsType.fields.photo_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.techDocsType.fields.description') }}</label>
                                <input class="form-control" type="text" name="description" id="description"
                                    value="{{ old('description', '') }}">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.techDocsType.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="authorized_roles">{{ trans('cruds.techDocsType.fields.authorized_roles') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="authorized_roles[]" id="authorized_roles"
                                    multiple>
                                    @foreach ($authorized_roles as $id => $authorized_role)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('authorized_roles', [])) ? 'selected' : '' }}>
                                            {{ $authorized_role }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('authorized_roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('authorized_roles') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.techDocsType.fields.authorized_roles_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="authorized_users">{{ trans('cruds.techDocsType.fields.authorized_users') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="authorized_users[]" id="authorized_users"
                                    multiple>
                                    @foreach ($authorized_users as $id => $authorized_user)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('authorized_users', [])) ? 'selected' : '' }}>
                                            {{ $authorized_user }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('authorized_users'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('authorized_users') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.techDocsType.fields.authorized_users_helper') }}</span>
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
            url: '{{ route('frontend.tech-docs-types.storeMedia') }}',
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
                @if (isset($techDocsType) && $techDocsType->photo)
                    var file = {!! json_encode($techDocsType->photo) !!}
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
