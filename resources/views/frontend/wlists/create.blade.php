@extends('layouts.frontend')
@section('content')
    <!--  -->
    @dump(get_defined_vars())
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card custom-card">
                    <div class="card-header">
                        <strong style="text-transform: uppercase;">
                            {{ trans('global.create') }} {{ trans('cruds.wlist.title_singular') }} for:
                        </strong>
                        {{ $boats[request('boat_id')] ?? 'boat not found' }}
                        ({{ $clients[request('client_id')] }})
                        <a class="btn btn-link" href="{{ route('frontend.boats.show', request('boat_id')) }}">
                            &lt;&lt;</a>

                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('frontend.wlists.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="client_id" value="{{ request('client_id') }}">
                            <input type="hidden" name="boat_id" value="{{ request('boat_id') }}">
                            <input type="hidden" name="marina_id" value="{{ request('marina_id') }}">
                            <input type="hidden" name="from_user_id" value="{{ auth()->user()->id }}">

                            @if ($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="btn-group btn-group-sm d-flex flex-wrap m-1" role="group"
                                    aria-label="Basic radio toggle button group">
                                    @foreach (App\Models\Wlist::ORDER_TYPE_RADIO as $key => $label)
                                        <input type="radio" class="btn-check" id="order_type_{{ $key }}"
                                            name="order_type" value="{{ $key }}"
                                            {{ old('order_type', '') === (string) $key ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-secondary"
                                            for="order_type_{{ $key }}">{{ $label }}</label>
                                    @endforeach
                                    @if ($errors->has('order_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('order_type') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.wlist.fields.order_type_helper') }}</span>
                                </div>


                                <div class="form-group-dropdowns">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option>For role...</option>
                                        @foreach ($for_roles as $id => $for_role)
                                            <option value="{{ $id }}"
                                                {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>
                                                {{ $for_role }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option>For user...</option>
                                        @foreach ($for_users as $id => $for_user)
                                            <option value="{{ $id }}"
                                                {{ in_array($id, old('for_users', [])) ? 'selected' : '' }}>
                                                {{ $for_user }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group-dropdowns">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option>Priority...</option>
                                        @foreach ($priorities as $id => $entry)
                                            <option value="{{ $id }}"
                                                {{ old('priority_id') == $id ? 'selected' : '' }}>{{ $entry }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option>Status...</option>
                                        @foreach (App\Models\Wlist::STATUS_RADIO as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>



                            @if ($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif

                            @if ($errors->has('from_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from_user') }}
                                </div>
                            @endif

                           <div class="form-group">
                            <label for="for_roles">{{ trans('cruds.wlist.fields.for_role') }}</label>
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
                            <span class="help-block">{{ trans('cruds.wlist.fields.for_role_helper') }}</span>
                        </div>

                           <div class="form-group">
                            <label for="for_users">{{ trans('cruds.wlist.fields.for_user') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_users[]" id="for_users" multiple>
                                @foreach($for_users as $id => $for_user)
                                    <option value="{{ $id }}" {{ in_array($id, old('for_users', [])) ? 'selected' : '' }}>{{ $for_user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.for_user_helper') }}</span>
                        </div>

                            @if ($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif

                            @if ($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif




                            <div class="form-group">
                                <label for="boat_namecomplete">{{ trans('cruds.wlist.fields.boat_namecomplete') }}</label>
                                <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete"
                                    value="{{ old('boat_namecomplete', '') }}">
                                @if ($errors->has('boat_namecomplete'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('boat_namecomplete') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.boat_namecomplete_helper') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ trans('cruds.wlist.fields.description') }}</label>
                                <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', '') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.description_helper') }}</span>
                            </div>

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
                                <label for="deadline">{{ trans('cruds.wlist.fields.deadline') }}</label>
                                <input class="form-control date" type="text" name="deadline" id="deadline"
                                    value="{{ old('deadline') }}">
                                @if ($errors->has('deadline'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('deadline') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.deadline_helper') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="url_invoice">{{ trans('cruds.wlist.fields.url_invoice') }}</label>
                                <input class="form-control" type="text" name="url_invoice" id="url_invoice"
                                    value="{{ old('url_invoice', '') }}">
                                @if ($errors->has('url_invoice'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('url_invoice') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.url_invoice_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.wlist.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', '') }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.notes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="internal_notes">{{ trans('cruds.wlist.fields.internal_notes') }}</label>
                                <input class="form-control" type="text" name="internal_notes" id="internal_notes"
                                    value="{{ old('internal_notes', '') }}">
                                @if ($errors->has('internal_notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('internal_notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.wlist.fields.internal_notes_helper') }}</span>
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
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('frontend.wlists.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
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
