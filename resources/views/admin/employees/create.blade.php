@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employees.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_employee">{{ trans('cruds.employee.fields.id_employee') }}</label>
                <input class="form-control {{ $errors->has('id_employee') ? 'is-invalid' : '' }}" type="text" name="id_employee" id="id_employee" value="{{ old('id_employee', '') }}">
                @if($errors->has('id_employee'))
                    <span class="text-danger">{{ $errors->first('id_employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.id_employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="namecomplete">{{ trans('cruds.employee.fields.namecomplete') }}</label>
                <input class="form-control {{ $errors->has('namecomplete') ? 'is-invalid' : '' }}" type="text" name="namecomplete" id="namecomplete" value="{{ old('namecomplete', '') }}">
                @if($errors->has('namecomplete'))
                    <span class="text-danger">{{ $errors->first('namecomplete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.namecomplete_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.employee.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_id">{{ trans('cruds.employee.fields.contact') }}</label>
                <select class="form-control select2 {{ $errors->has('contact') ? 'is-invalid' : '' }}" name="contact_id" id="contact_id">
                    @foreach($contacts as $id => $entry)
                        <option value="{{ $id }}" {{ old('contact_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact'))
                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.employee.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.employee.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract_starts">{{ trans('cruds.employee.fields.contract_starts') }}</label>
                <input class="form-control date {{ $errors->has('contract_starts') ? 'is-invalid' : '' }}" type="text" name="contract_starts" id="contract_starts" value="{{ old('contract_starts') }}">
                @if($errors->has('contract_starts'))
                    <span class="text-danger">{{ $errors->first('contract_starts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.contract_starts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract_ends">{{ trans('cruds.employee.fields.contract_ends') }}</label>
                <input class="form-control date {{ $errors->has('contract_ends') ? 'is-invalid' : '' }}" type="text" name="contract_ends" id="contract_ends" value="{{ old('contract_ends') }}">
                @if($errors->has('contract_ends'))
                    <span class="text-danger">{{ $errors->first('contract_ends') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.contract_ends_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category">{{ trans('cruds.employee.fields.category') }}</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text" name="category" id="category" value="{{ old('category', '') }}">
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.employee.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.employee.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.employee.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.employee.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" required {{ old('active', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="active">{{ trans('cruds.employee.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employee.fields.active_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.employees.storeMedia') }}',
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
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($employee) && $employee->photo)
      var file = {!! json_encode($employee->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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