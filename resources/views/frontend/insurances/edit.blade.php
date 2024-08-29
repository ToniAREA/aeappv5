@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.insurance.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.insurances.update", [$insurance->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $insurance->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_active">{{ trans('cruds.insurance.fields.is_active') }}</label>
                            </div>
                            @if($errors->has('is_active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.is_active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="provider_name">{{ trans('cruds.insurance.fields.provider_name') }}</label>
                            <input class="form-control" type="text" name="provider_name" id="provider_name" value="{{ old('provider_name', $insurance->provider_name) }}" required>
                            @if($errors->has('provider_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('provider_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.provider_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="insurance_logo">{{ trans('cruds.insurance.fields.insurance_logo') }}</label>
                            <div class="needsclick dropzone" id="insurance_logo-dropzone">
                            </div>
                            @if($errors->has('insurance_logo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('insurance_logo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.insurance_logo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.insurance.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $insurance->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="policy_number">{{ trans('cruds.insurance.fields.policy_number') }}</label>
                            <input class="form-control" type="text" name="policy_number" id="policy_number" value="{{ old('policy_number', $insurance->policy_number) }}">
                            @if($errors->has('policy_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('policy_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.policy_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.insurance.fields.period') }}</label>
                            @foreach(App\Models\Insurance::PERIOD_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="period_{{ $key }}" name="period" value="{{ $key }}" {{ old('period', $insurance->period) === (string) $key ? 'checked' : '' }}>
                                    <label for="period_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('period'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.period_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="period_cost">{{ trans('cruds.insurance.fields.period_cost') }}</label>
                            <input class="form-control" type="number" name="period_cost" id="period_cost" value="{{ old('period_cost', $insurance->period_cost) }}" step="0.01">
                            @if($errors->has('period_cost'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('period_cost') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.period_cost_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coverage_type">{{ trans('cruds.insurance.fields.coverage_type') }}</label>
                            <input class="form-control" type="text" name="coverage_type" id="coverage_type" value="{{ old('coverage_type', $insurance->coverage_type) }}">
                            @if($errors->has('coverage_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coverage_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.coverage_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.insurance.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $insurance->start_date) }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.insurance.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $insurance->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="files">{{ trans('cruds.insurance.fields.files') }}</label>
                            <div class="needsclick dropzone" id="files-dropzone">
                            </div>
                            @if($errors->has('files'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('files') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.files_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.insurance.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $insurance->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.insurance.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $insurance->internalnotes) }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.internalnotes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a">{{ trans('cruds.insurance.fields.link_a') }}</label>
                            <input class="form-control" type="text" name="link_a" id="link_a" value="{{ old('link_a', $insurance->link_a) }}">
                            @if($errors->has('link_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.link_a_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a_description">{{ trans('cruds.insurance.fields.link_a_description') }}</label>
                            <input class="form-control" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', $insurance->link_a_description) }}">
                            @if($errors->has('link_a_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.link_a_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b">{{ trans('cruds.insurance.fields.link_b') }}</label>
                            <input class="form-control" type="text" name="link_b" id="link_b" value="{{ old('link_b', $insurance->link_b) }}">
                            @if($errors->has('link_b'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.link_b_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b_description">{{ trans('cruds.insurance.fields.link_b_description') }}</label>
                            <input class="form-control" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', $insurance->link_b_description) }}">
                            @if($errors->has('link_b_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.insurance.fields.link_b_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contacts">{{ trans('cruds.insurance.fields.contacts') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="contacts[]" id="contacts" multiple>
                                @foreach($contacts as $id => $contact)
                                    <option value="{{ $id }}" {{ (in_array($id, old('contacts', [])) || $insurance->contacts->contains($id)) ? 'selected' : '' }}>{{ $contact }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contacts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contacts') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.insuranceLogoDropzone = {
    url: '{{ route('frontend.insurances.storeMedia') }}',
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
    url: '{{ route('frontend.insurances.storeMedia') }}',
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