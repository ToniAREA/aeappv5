@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.wlog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wlogs.update", [$wlog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="wlist_id">{{ trans('cruds.wlog.fields.wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('wlist') ? 'is-invalid' : '' }}" name="wlist_id" id="wlist_id">
                    @foreach($wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $wlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wlist'))
                    <span class="text-danger">{{ $errors->first('wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_namecomplete">{{ trans('cruds.wlog.fields.boat_namecomplete') }}</label>
                <input class="form-control {{ $errors->has('boat_namecomplete') ? 'is-invalid' : '' }}" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', $wlog->boat_namecomplete) }}">
                @if($errors->has('boat_namecomplete'))
                    <span class="text-danger">{{ $errors->first('boat_namecomplete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.boat_namecomplete_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.wlog.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $wlog->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.wlog.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $wlog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('marina_id') ? old('marina_id') : $wlog->marina->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('marina'))
                    <span class="text-danger">{{ $errors->first('marina') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.marina_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.wlog.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $wlog->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hours">{{ trans('cruds.wlog.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', $wlog->hours) }}" step="0.01" required max="24">
                @if($errors->has('hours'))
                    <span class="text-danger">{{ $errors->first('hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.wlog.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $wlog->hourly_rate) }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <span class="text-danger">{{ $errors->first('hourly_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('travel_cost_included') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="travel_cost_included" value="0">
                    <input class="form-check-input" type="checkbox" name="travel_cost_included" id="travel_cost_included" value="1" {{ $wlog->travel_cost_included || old('travel_cost_included', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="travel_cost_included">{{ trans('cruds.wlog.fields.travel_cost_included') }}</label>
                </div>
                @if($errors->has('travel_cost_included'))
                    <span class="text-danger">{{ $errors->first('travel_cost_included') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.travel_cost_included_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_travel_cost">{{ trans('cruds.wlog.fields.total_travel_cost') }}</label>
                <input class="form-control {{ $errors->has('total_travel_cost') ? 'is-invalid' : '' }}" type="number" name="total_travel_cost" id="total_travel_cost" value="{{ old('total_travel_cost', $wlog->total_travel_cost) }}" step="0.01">
                @if($errors->has('total_travel_cost'))
                    <span class="text-danger">{{ $errors->first('total_travel_cost') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.total_travel_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_access_cost">{{ trans('cruds.wlog.fields.total_access_cost') }}</label>
                <input class="form-control {{ $errors->has('total_access_cost') ? 'is-invalid' : '' }}" type="number" name="total_access_cost" id="total_access_cost" value="{{ old('total_access_cost', $wlog->total_access_cost) }}" step="0.01">
                @if($errors->has('total_access_cost'))
                    <span class="text-danger">{{ $errors->first('total_access_cost') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.total_access_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('wlist_finished') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="wlist_finished" value="0">
                    <input class="form-check-input" type="checkbox" name="wlist_finished" id="wlist_finished" value="1" {{ $wlog->wlist_finished || old('wlist_finished', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="wlist_finished">{{ trans('cruds.wlog.fields.wlist_finished') }}</label>
                </div>
                @if($errors->has('wlist_finished'))
                    <span class="text-danger">{{ $errors->first('wlist_finished') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.wlist_finished_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced_line') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced_line" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $wlog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced_line">{{ trans('cruds.wlog.fields.invoiced_line') }}</label>
                </div>
                @if($errors->has('invoiced_line'))
                    <span class="text-danger">{{ $errors->first('invoiced_line') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.invoiced_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.wlog.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes', $wlog->notes) }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.wlog.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $wlog->internal_notes) }}">
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
                <label for="financial_document_id">{{ trans('cruds.wlog.fields.financial_document') }}</label>
                <select class="form-control select2 {{ $errors->has('financial_document') ? 'is-invalid' : '' }}" name="financial_document_id" id="financial_document_id">
                    @foreach($financial_documents as $id => $entry)
                        <option value="{{ $id }}" {{ (old('financial_document_id') ? old('financial_document_id') : $wlog->financial_document->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('financial_document'))
                    <span class="text-danger">{{ $errors->first('financial_document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.wlog.fields.financial_document_helper') }}</span>
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