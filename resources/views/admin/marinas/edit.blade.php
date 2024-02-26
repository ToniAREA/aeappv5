@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.marina.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.marinas.update", [$marina->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.marina.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $marina->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marina_photo">{{ trans('cruds.marina.fields.marina_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('marina_photo') ? 'is-invalid' : '' }}" id="marina_photo-dropzone">
                </div>
                @if($errors->has('marina_photo'))
                    <span class="text-danger">{{ $errors->first('marina_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.marina_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.marina.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $marina->coordinates) }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.coordinates_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.marina.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $marina->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.marina.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', $marina->link_description) }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.marina.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $marina->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.marina.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $marina->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_docs_id">{{ trans('cruds.marina.fields.contact_docs') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_docs') ? 'is-invalid' : '' }}" name="contact_docs_id" id="contact_docs_id">
                    @foreach($contact_docs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('contact_docs_id') ? old('contact_docs_id') : $marina->contact_docs->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_docs'))
                    <span class="text-danger">{{ $errors->first('contact_docs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.marina.fields.contact_docs_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_use">{{ trans('cruds.marina.fields.last_use') }}</label>
                <input class="form-control datetime {{ $errors->has('last_use') ? 'is-invalid' : '' }}" type="text" name="last_use" id="last_use" value="{{ old('last_use', $marina->last_use) }}">
                @if($errors->has('last_use'))
                    <span class="text-danger">{{ $errors->first('last_use') }}</span>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.marinaPhotoDropzone = {
    url: '{{ route('admin.marinas.storeMedia') }}',
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