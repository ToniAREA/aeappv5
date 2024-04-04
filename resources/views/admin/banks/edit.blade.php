@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bank.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.banks.update", [$bank->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $bank->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.bank.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bank.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $bank->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="branch">{{ trans('cruds.bank.fields.branch') }}</label>
                <input class="form-control {{ $errors->has('branch') ? 'is-invalid' : '' }}" type="text" name="branch" id="branch" value="{{ old('branch', $bank->branch) }}">
                @if($errors->has('branch'))
                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="account_number">{{ trans('cruds.bank.fields.account_number') }}</label>
                <input class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" type="text" name="account_number" id="account_number" value="{{ old('account_number', $bank->account_number) }}" required>
                @if($errors->has('account_number'))
                    <span class="text-danger">{{ $errors->first('account_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.account_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account_name">{{ trans('cruds.bank.fields.account_name') }}</label>
                <input class="form-control {{ $errors->has('account_name') ? 'is-invalid' : '' }}" type="text" name="account_name" id="account_name" value="{{ old('account_name', $bank->account_name) }}">
                @if($errors->has('account_name'))
                    <span class="text-danger">{{ $errors->first('account_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.account_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="swift_code">{{ trans('cruds.bank.fields.swift_code') }}</label>
                <input class="form-control {{ $errors->has('swift_code') ? 'is-invalid' : '' }}" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', $bank->swift_code) }}">
                @if($errors->has('swift_code'))
                    <span class="text-danger">{{ $errors->first('swift_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.swift_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.bank.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $bank->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="join_date">{{ trans('cruds.bank.fields.join_date') }}</label>
                <input class="form-control date {{ $errors->has('join_date') ? 'is-invalid' : '' }}" type="text" name="join_date" id="join_date" value="{{ old('join_date', $bank->join_date) }}">
                @if($errors->has('join_date'))
                    <span class="text-danger">{{ $errors->first('join_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.join_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_balance">{{ trans('cruds.bank.fields.current_balance') }}</label>
                <input class="form-control {{ $errors->has('current_balance') ? 'is-invalid' : '' }}" type="number" name="current_balance" id="current_balance" value="{{ old('current_balance', $bank->current_balance) }}" step="0.01">
                @if($errors->has('current_balance'))
                    <span class="text-danger">{{ $errors->first('current_balance') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.current_balance_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.bank.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $bank->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.bank.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $bank->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a">{{ trans('cruds.bank.fields.link_a') }}</label>
                <input class="form-control {{ $errors->has('link_a') ? 'is-invalid' : '' }}" type="text" name="link_a" id="link_a" value="{{ old('link_a', $bank->link_a) }}">
                @if($errors->has('link_a'))
                    <span class="text-danger">{{ $errors->first('link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a_description">{{ trans('cruds.bank.fields.link_a_description') }}</label>
                <input class="form-control {{ $errors->has('link_a_description') ? 'is-invalid' : '' }}" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', $bank->link_a_description) }}">
                @if($errors->has('link_a_description'))
                    <span class="text-danger">{{ $errors->first('link_a_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.link_a_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b">{{ trans('cruds.bank.fields.link_b') }}</label>
                <input class="form-control {{ $errors->has('link_b') ? 'is-invalid' : '' }}" type="text" name="link_b" id="link_b" value="{{ old('link_b', $bank->link_b) }}">
                @if($errors->has('link_b'))
                    <span class="text-danger">{{ $errors->first('link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b_description">{{ trans('cruds.bank.fields.link_b_description') }}</label>
                <input class="form-control {{ $errors->has('link_b_description') ? 'is-invalid' : '' }}" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', $bank->link_b_description) }}">
                @if($errors->has('link_b_description'))
                    <span class="text-danger">{{ $errors->first('link_b_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.link_b_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.bank.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <span class="text-danger">{{ $errors->first('files') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bank_logo">{{ trans('cruds.bank.fields.bank_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('bank_logo') ? 'is-invalid' : '' }}" id="bank_logo-dropzone">
                </div>
                @if($errors->has('bank_logo'))
                    <span class="text-danger">{{ $errors->first('bank_logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bank.fields.bank_logo_helper') }}</span>
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
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.banks.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
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
@if(isset($bank) && $bank->files)
          var files =
            {!! json_encode($bank->files) !!}
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
<script>
    Dropzone.options.bankLogoDropzone = {
    url: '{{ route('admin.banks.storeMedia') }}',
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
      $('form').find('input[name="bank_logo"]').remove()
      $('form').append('<input type="hidden" name="bank_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="bank_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($bank) && $bank->bank_logo)
      var file = {!! json_encode($bank->bank_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="bank_logo" value="' + file.file_name + '">')
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