@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.boat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boats.update", [$boat->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ref">{{ trans('cruds.boat.fields.ref') }}</label>
                <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" type="text" name="ref" id="ref" value="{{ old('ref', $boat->ref) }}">
                @if($errors->has('ref'))
                    <span class="text-danger">{{ $errors->first('ref') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.ref_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_type">{{ trans('cruds.boat.fields.boat_type') }}</label>
                <input class="form-control {{ $errors->has('boat_type') ? 'is-invalid' : '' }}" type="text" name="boat_type" id="boat_type" value="{{ old('boat_type', $boat->boat_type) }}">
                @if($errors->has('boat_type'))
                    <span class="text-danger">{{ $errors->first('boat_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.boat_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.boat.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $boat->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_photo">{{ trans('cruds.boat.fields.boat_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('boat_photo') ? 'is-invalid' : '' }}" id="boat_photo-dropzone">
                </div>
                @if($errors->has('boat_photo'))
                    <span class="text-danger">{{ $errors->first('boat_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.boat_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="imo">{{ trans('cruds.boat.fields.imo') }}</label>
                <input class="form-control {{ $errors->has('imo') ? 'is-invalid' : '' }}" type="text" name="imo" id="imo" value="{{ old('imo', $boat->imo) }}">
                @if($errors->has('imo'))
                    <span class="text-danger">{{ $errors->first('imo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.imo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mmsi">{{ trans('cruds.boat.fields.mmsi') }}</label>
                <input class="form-control {{ $errors->has('mmsi') ? 'is-invalid' : '' }}" type="text" name="mmsi" id="mmsi" value="{{ old('mmsi', $boat->mmsi) }}">
                @if($errors->has('mmsi'))
                    <span class="text-danger">{{ $errors->first('mmsi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.mmsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marina_id">{{ trans('cruds.boat.fields.marina') }}</label>
                <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id" id="marina_id">
                    @foreach($marinas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('marina_id') ? old('marina_id') : $boat->marina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marina'))
                    <span class="text-danger">{{ $errors->first('marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sat_phone">{{ trans('cruds.boat.fields.sat_phone') }}</label>
                <input class="form-control {{ $errors->has('sat_phone') ? 'is-invalid' : '' }}" type="text" name="sat_phone" id="sat_phone" value="{{ old('sat_phone', $boat->sat_phone) }}">
                @if($errors->has('sat_phone'))
                    <span class="text-danger">{{ $errors->first('sat_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.sat_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.boat.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $boat->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.boat.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $boat->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clients">{{ trans('cruds.boat.fields.clients') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('clients') ? 'is-invalid' : '' }}" name="clients[]" id="clients" multiple>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (in_array($id, old('clients', [])) || $boat->clients->contains($id)) ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('clients'))
                    <span class="text-danger">{{ $errors->first('clients') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.clients_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.boat.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $boat->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.boat.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', $boat->link_description) }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_use">{{ trans('cruds.boat.fields.last_use') }}</label>
                <input class="form-control datetime {{ $errors->has('last_use') ? 'is-invalid' : '' }}" type="text" name="last_use" id="last_use" value="{{ old('last_use', $boat->last_use) }}">
                @if($errors->has('last_use'))
                    <span class="text-danger">{{ $errors->first('last_use') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.last_use_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="settings_data">{{ trans('cruds.boat.fields.settings_data') }}</label>
                <textarea class="form-control {{ $errors->has('settings_data') ? 'is-invalid' : '' }}" name="settings_data" id="settings_data">{{ old('settings_data', $boat->settings_data) }}</textarea>
                @if($errors->has('settings_data'))
                    <span class="text-danger">{{ $errors->first('settings_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.settings_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="public_ip">{{ trans('cruds.boat.fields.public_ip') }}</label>
                <input class="form-control {{ $errors->has('public_ip') ? 'is-invalid' : '' }}" type="text" name="public_ip" id="public_ip" value="{{ old('public_ip', $boat->public_ip) }}">
                @if($errors->has('public_ip'))
                    <span class="text-danger">{{ $errors->first('public_ip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.public_ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.boat.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $boat->coordinates) }}">
                @if($errors->has('coordinates'))
                    <span class="text-danger">{{ $errors->first('coordinates') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.coordinates_helper') }}</span>
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
    Dropzone.options.boatPhotoDropzone = {
    url: '{{ route('admin.boats.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="boat_photo"]').remove()
      $('form').append('<input type="hidden" name="boat_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="boat_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($boat) && $boat->boat_photo)
      var file = {!! json_encode($boat->boat_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="boat_photo" value="' + file.file_name + '">')
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