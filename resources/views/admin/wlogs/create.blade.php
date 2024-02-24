@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.wlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wlogs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id">
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ old('wlist_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <span class="text-danger">{{ $errors->first('wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_namecomplete">{{ trans('cruds.wlog.fields.boat_namecomplete') }}</label>
                <input class="form-control {{ $errors->has('boat_namecomplete') ? 'is-invalid' : '' }}" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', '') }}">
                @if($errors->has('boat_namecomplete'))
                    <span class="text-danger">{{ $errors->first('boat_namecomplete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.boat_namecomplete_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="marina_id">{{ trans('cruds.wlog.fields.marina') }}</label>
                <select class="form-control select2 {{ $errors->has('marina') ? 'is-invalid' : '' }}" name="marina_id" id="marina_id">
                    @foreach($marinas as $id => $entry)
                        <option value="{{ $id }}" {{ old('marina_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marina'))
                    <span class="text-danger">{{ $errors->first('marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.wlog.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', '') }}" step="0.01" max="24">
                @if($errors->has('hours'))
                    <span class="text-danger">{{ $errors->first('hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.wlog.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', '') }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <span class="text-danger">{{ $errors->first('hourly_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('wlist_finished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="wlist_finished" value="0">
                    <input class="form-check-input" type="checkbox" name="wlist_finished" id="wlist_finished" value="1" {{ old('wlist_finished', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="wlist_finished">{{ trans('cruds.wlog.fields.wlist_finished') }}</label>
                </div>
                @if($errors->has('wlist_finished'))
                    <span class="text-danger">{{ $errors->first('wlist_finished') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.wlist_finished_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_number_id">{{ trans('cruds.wlog.fields.proforma_number') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma_number') ? 'is-invalid' : '' }}" name="proforma_number_id" id="proforma_number_id">
                    @foreach($proforma_numbers as $id => $entry)
                        <option value="{{ $id }}" {{ old('proforma_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma_number'))
                    <span class="text-danger">{{ $errors->first('proforma_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.proforma_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced_line') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced_line" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ old('invoiced_line', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced_line">{{ trans('cruds.wlog.fields.invoiced_line') }}</label>
                </div>
                @if($errors->has('invoiced_line'))
                    <span class="text-danger">{{ $errors->first('invoiced_line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.invoiced_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.wlog.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.wlog.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.wlog.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.photos_helper') }}</span>
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
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.wlogs.storeMedia') }}',
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
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
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
    init: function () {
@if(isset($wlog) && $wlog->photos)
      var files = {!! json_encode($wlog->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
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