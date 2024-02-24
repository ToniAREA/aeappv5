@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.wlog.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.wlogs.update", [$wlog->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id">
                                @foreach($wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $wlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.wlog.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', $wlog->boat_namecomplete) }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $wlog->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $wlog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="marina_id">{{ trans('cruds.wlog.fields.marina') }}</label>
                            <select class="form-control select2" name="marina_id" id="marina_id">
                                @foreach($marinas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('marina_id') ? old('marina_id') : $wlog->marina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('marina'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('marina') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.marina_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.wlog.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $wlog->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                            <input class="form-control" type="number" name="hours" id="hours" value="{{ old('hours', $wlog->hours) }}" step="0.01" max="24">
                            @if($errors->has('hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hourly_rate">{{ trans('cruds.wlog.fields.hourly_rate') }}</label>
                            <input class="form-control" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $wlog->hourly_rate) }}" step="0.01">
                            @if($errors->has('hourly_rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hourly_rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.hourly_rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="wlist_finished" value="0">
                                <input type="checkbox" name="wlist_finished" id="wlist_finished" value="1" {{ $wlog->wlist_finished || old('wlist_finished', 0) === 1 ? 'checked' : '' }}>
                                <label for="wlist_finished">{{ trans('cruds.wlog.fields.wlist_finished') }}</label>
                            </div>
                            @if($errors->has('wlist_finished'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist_finished') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.wlist_finished_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_number_id">{{ trans('cruds.wlog.fields.proforma_number') }}</label>
                            <select class="form-control select2" name="proforma_number_id" id="proforma_number_id">
                                @foreach($proforma_numbers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('proforma_number_id') ? old('proforma_number_id') : $wlog->proforma_number->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('proforma_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="invoiced_line" value="0">
                                <input type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $wlog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                                <label for="invoiced_line">{{ trans('cruds.wlog.fields.invoiced_line') }}</label>
                            </div>
                            @if($errors->has('invoiced_line'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoiced_line') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.invoiced_line_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.wlog.fields.notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes', $wlog->notes) }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.wlog.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $wlog->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlog.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.wlog.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('frontend.wlogs.storeMedia') }}',
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