@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.carePlan.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.care-plans.update', [$carePlan->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_online" value="0">
                                    <input type="checkbox" name="is_online" id="is_online" value="1"
                                        {{ $carePlan->is_online || old('is_online', 0) === 1 ? 'checked' : '' }}>
                                    <label for="is_online">{{ trans('cruds.carePlan.fields.is_online') }}</label>
                                </div>
                                @if ($errors->has('is_online'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_online') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.is_online_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.carePlan.fields.name') }}</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name', $carePlan->name) }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="short_description">{{ trans('cruds.carePlan.fields.short_description') }}</label>
                                <input class="form-control" type="text" name="short_description" id="short_description"
                                    value="{{ old('short_description', $carePlan->short_description) }}">
                                @if ($errors->has('short_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('short_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.carePlan.fields.short_description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.carePlan.fields.description') }}</label>
                                <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $carePlan->description) !!}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="photo">{{ trans('cruds.carePlan.fields.photo') }}</label>
                                <div class="needsclick dropzone" id="photo-dropzone">
                                </div>
                                @if ($errors->has('photo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('photo') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.photo_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required"
                                    for="checkpoints">{{ trans('cruds.carePlan.fields.checkpoints') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="checkpoints[]" id="checkpoints" multiple
                                    required>
                                    @foreach ($checkpoints as $id => $checkpoint)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('checkpoints', [])) || $carePlan->checkpoints->contains($id) ? 'selected' : '' }}>
                                            {{ $checkpoint }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('checkpoints'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('checkpoints') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.checkpoints_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.carePlan.fields.period') }}</label>
                                @foreach (App\Models\CarePlan::PERIOD_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="period_{{ $key }}" name="period"
                                            value="{{ $key }}"
                                            {{ old('period', $carePlan->period) === (string) $key ? 'checked' : '' }}
                                            required>
                                        <label for="period_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('period'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('period') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.period_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required"
                                    for="period_price">{{ trans('cruds.carePlan.fields.period_price') }}</label>
                                <input class="form-control" type="number" name="period_price" id="period_price"
                                    value="{{ old('period_price', $carePlan->period_price) }}" step="0.01" required>
                                @if ($errors->has('period_price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('period_price') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.period_price_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="seo_title">{{ trans('cruds.carePlan.fields.seo_title') }}</label>
                                <input class="form-control" type="text" name="seo_title" id="seo_title"
                                    value="{{ old('seo_title', $carePlan->seo_title) }}">
                                @if ($errors->has('seo_title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.seo_title_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="seo_meta_description">{{ trans('cruds.carePlan.fields.seo_meta_description') }}</label>
                                <input class="form-control" type="text" name="seo_meta_description"
                                    id="seo_meta_description"
                                    value="{{ old('seo_meta_description', $carePlan->seo_meta_description) }}">
                                @if ($errors->has('seo_meta_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_meta_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.carePlan.fields.seo_meta_description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="seo_slug">{{ trans('cruds.carePlan.fields.seo_slug') }}</label>
                                <input class="form-control" type="text" name="seo_slug" id="seo_slug"
                                    value="{{ old('seo_slug', $carePlan->seo_slug) }}">
                                @if ($errors->has('seo_slug'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('seo_slug') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.carePlan.fields.seo_slug_helper') }}</span>
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
                                            '{{ route('frontend.care-plans.storeCKEditorImages') }}',
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
                                        data.append('crud_id', '{{ $carePlan->id ?? 0 }}');
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
        Dropzone.options.photoDropzone = {
            url: '{{ route('frontend.care-plans.storeMedia') }}',
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
                @if (isset($carePlan) && $carePlan->photo)
                    var file = {!! json_encode($carePlan->photo) !!}
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
