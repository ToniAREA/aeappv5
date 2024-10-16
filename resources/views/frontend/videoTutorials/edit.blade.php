@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.videoTutorial.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.video-tutorials.update', [$videoTutorial->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_online" value="0">
                                    <input type="checkbox" name="is_online" id="is_online" value="1"
                                        {{ $videoTutorial->is_online || old('is_online', 0) === 1 ? 'checked' : '' }}>
                                    <label for="is_online">{{ trans('cruds.videoTutorial.fields.is_online') }}</label>
                                </div>
                                @if ($errors->has('is_online'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_online') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.is_online_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ trans('cruds.videoTutorial.fields.title') }}</label>
                                <input class="form-control" type="text" name="title" id="title"
                                    value="{{ old('title', $videoTutorial->title) }}">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.title_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.videoTutorial.fields.description') }}</label>
                                <input class="form-control" type="text" name="description" id="description"
                                    value="{{ old('description', $videoTutorial->description) }}">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.videoTutorial.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="image">{{ trans('cruds.videoTutorial.fields.image') }}</label>
                                <div class="needsclick dropzone" id="image-dropzone">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.image_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="video_url">{{ trans('cruds.videoTutorial.fields.video_url') }}</label>
                                <input class="form-control" type="text" name="video_url" id="video_url"
                                    value="{{ old('video_url', $videoTutorial->video_url) }}">
                                @if ($errors->has('video_url'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('video_url') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.video_url_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="subjects">{{ trans('cruds.videoTutorial.fields.subjects') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="subjects[]" id="subjects" multiple>
                                    @foreach ($subjects as $id => $subject)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('subjects', [])) || $videoTutorial->subjects->contains($id) ? 'selected' : '' }}>
                                            {{ $subject }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('subjects'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subjects') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.subjects_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tags">{{ trans('cruds.videoTutorial.fields.tags') }}</label>
                                <input class="form-control" type="text" name="tags" id="tags"
                                    value="{{ old('tags', $videoTutorial->tags) }}">
                                @if ($errors->has('tags'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tags') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.tags_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="seo_title">{{ trans('cruds.videoTutorial.fields.seo_title') }}</label>
                                <input class="form-control" type="text" name="seo_title" id="seo_title"
                                    value="{{ old('seo_title', $videoTutorial->seo_title) }}">
                                @if ($errors->has('seo_title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.seo_title_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="seo_meta_description">{{ trans('cruds.videoTutorial.fields.seo_meta_description') }}</label>
                                <input class="form-control" type="text" name="seo_meta_description"
                                    id="seo_meta_description"
                                    value="{{ old('seo_meta_description', $videoTutorial->seo_meta_description) }}">
                                @if ($errors->has('seo_meta_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_meta_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.videoTutorial.fields.seo_meta_description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="seo_slug">{{ trans('cruds.videoTutorial.fields.seo_slug') }}</label>
                                <input class="form-control" type="text" name="seo_slug" id="seo_slug"
                                    value="{{ old('seo_slug', $videoTutorial->seo_slug) }}">
                                @if ($errors->has('seo_slug'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_slug') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.videoTutorial.fields.seo_slug_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="authorized_roles">{{ trans('cruds.videoTutorial.fields.authorized_roles') }}</label>
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
                                            {{ in_array($id, old('authorized_roles', [])) || $videoTutorial->authorized_roles->contains($id) ? 'selected' : '' }}>
                                            {{ $authorized_role }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('authorized_roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('authorized_roles') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.videoTutorial.fields.authorized_roles_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="authorized_users">{{ trans('cruds.videoTutorial.fields.authorized_users') }}</label>
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
                                            {{ in_array($id, old('authorized_users', [])) || $videoTutorial->authorized_users->contains($id) ? 'selected' : '' }}>
                                            {{ $authorized_user }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('authorized_users'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('authorized_users') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.videoTutorial.fields.authorized_users_helper') }}</span>
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
        Dropzone.options.imageDropzone = {
            url: '{{ route('frontend.video-tutorials.storeMedia') }}',
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
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($videoTutorial) && $videoTutorial->image)
                    var file = {!! json_encode($videoTutorial->image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
