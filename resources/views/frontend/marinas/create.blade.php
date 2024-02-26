@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.marina.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.marinas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.marina.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="marina_photo">{{ trans('cruds.marina.fields.marina_photo') }}</label>
                            <div class="needsclick dropzone" id="marina_photo-dropzone">
                            </div>
                            @if($errors->has('marina_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('marina_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.marina_photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.marina.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.coordinates_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.marina.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.marina.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.link_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.marina.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.marina.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_docs_id">{{ trans('cruds.marina.fields.contact_docs') }}</label>
                            <select class="form-control select2" name="contact_docs_id" id="contact_docs_id">
                                @foreach($contact_docs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('contact_docs_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contact_docs'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_docs') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.contact_docs_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_use">{{ trans('cruds.marina.fields.last_use') }}</label>
                            <input class="form-control datetime" type="text" name="last_use" id="last_use" value="{{ old('last_use') }}">
                            @if($errors->has('last_use'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_use') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.marina.fields.last_use_helper') }}</span>
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
    Dropzone.options.marinaPhotoDropzone = {
    url: '{{ route('frontend.marinas.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="marina_photo"]').remove()
      $('form').append('<input type="hidden" name="marina_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="marina_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($marina) && $marina->marina_photo)
      var file = {!! json_encode($marina->marina_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="marina_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
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