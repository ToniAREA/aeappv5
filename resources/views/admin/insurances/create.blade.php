@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.insurance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.insurances.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.insurance.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="provider_name">{{ trans('cruds.insurance.fields.provider_name') }}</label>
                <input class="form-control {{ $errors->has('provider_name') ? 'is-invalid' : '' }}" type="text" name="provider_name" id="provider_name" value="{{ old('provider_name', '') }}" required>
                @if($errors->has('provider_name'))
                    <span class="text-danger">{{ $errors->first('provider_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.provider_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="insurance_logo">{{ trans('cruds.insurance.fields.insurance_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('insurance_logo') ? 'is-invalid' : '' }}" id="insurance_logo-dropzone">
                </div>
                @if($errors->has('insurance_logo'))
                    <span class="text-danger">{{ $errors->first('insurance_logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.insurance_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.insurance.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="policy_number">{{ trans('cruds.insurance.fields.policy_number') }}</label>
                <input class="form-control {{ $errors->has('policy_number') ? 'is-invalid' : '' }}" type="text" name="policy_number" id="policy_number" value="{{ old('policy_number', '') }}">
                @if($errors->has('policy_number'))
                    <span class="text-danger">{{ $errors->first('policy_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.policy_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.insurance.fields.period') }}</label>
                @foreach(App\Models\Insurance::PERIOD_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('period') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', 'annually') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="period_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('period'))
                    <span class="text-danger">{{ $errors->first('period') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.period_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="period_cost">{{ trans('cruds.insurance.fields.period_cost') }}</label>
                <input class="form-control {{ $errors->has('period_cost') ? 'is-invalid' : '' }}" type="number" name="period_cost" id="period_cost" value="{{ old('period_cost', '') }}" step="0.01">
                @if($errors->has('period_cost'))
                    <span class="text-danger">{{ $errors->first('period_cost') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.period_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coverage_type">{{ trans('cruds.insurance.fields.coverage_type') }}</label>
                <input class="form-control {{ $errors->has('coverage_type') ? 'is-invalid' : '' }}" type="text" name="coverage_type" id="coverage_type" value="{{ old('coverage_type', '') }}">
                @if($errors->has('coverage_type'))
                    <span class="text-danger">{{ $errors->first('coverage_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.coverage_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.insurance.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.insurance.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.insurance.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.insurance.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.insurance.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a">{{ trans('cruds.insurance.fields.link_a') }}</label>
                <input class="form-control {{ $errors->has('link_a') ? 'is-invalid' : '' }}" type="text" name="link_a" id="link_a" value="{{ old('link_a', '') }}">
                @if($errors->has('link_a'))
                    <span class="text-danger">{{ $errors->first('link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a_description">{{ trans('cruds.insurance.fields.link_a_description') }}</label>
                <input class="form-control {{ $errors->has('link_a_description') ? 'is-invalid' : '' }}" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', '') }}">
                @if($errors->has('link_a_description'))
                    <span class="text-danger">{{ $errors->first('link_a_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.link_a_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b">{{ trans('cruds.insurance.fields.link_b') }}</label>
                <input class="form-control {{ $errors->has('link_b') ? 'is-invalid' : '' }}" type="text" name="link_b" id="link_b" value="{{ old('link_b', '') }}">
                @if($errors->has('link_b'))
                    <span class="text-danger">{{ $errors->first('link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b_description">{{ trans('cruds.insurance.fields.link_b_description') }}</label>
                <input class="form-control {{ $errors->has('link_b_description') ? 'is-invalid' : '' }}" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', '') }}">
                @if($errors->has('link_b_description'))
                    <span class="text-danger">{{ $errors->first('link_b_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.link_b_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contacts">{{ trans('cruds.insurance.fields.contacts') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('contacts') ? 'is-invalid' : '' }}" name="contacts[]" id="contacts" multiple>
                    @foreach($contacts as $id => $contact)
                        <option value="{{ $id }}" {{ in_array($id, old('contacts', [])) ? 'selected' : '' }}>{{ $contact }}</option>
                    @endforeach
                </select>
                @if($errors->has('contacts'))
                    <span class="text-danger">{{ $errors->first('contacts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.insurance.fields.contacts_helper') }}</span>
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
    Dropzone.options.insuranceLogoDropzone = {
    url: '{{ route('admin.insurances.storeMedia') }}',
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
      $('form').find('input[name="insurance_logo"]').remove()
      $('form').append('<input type="hidden" name="insurance_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="insurance_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($insurance) && $insurance->insurance_logo)
      var file = {!! json_encode($insurance->insurance_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="insurance_logo" value="' + file.file_name + '">')
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
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.insurances.storeMedia') }}',
    maxFilesize: 15, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($insurance) && $insurance->files)
          var files =
            {!! json_encode($insurance->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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