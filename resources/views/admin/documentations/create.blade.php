@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.documentation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.documentations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.documentation.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="category_id">{{ trans('cruds.documentation.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expiration_date">{{ trans('cruds.documentation.fields.expiration_date') }}</label>
                <input class="form-control date {{ $errors->has('expiration_date') ? 'is-invalid' : '' }}" type="text" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}" required>
                @if($errors->has('expiration_date'))
                    <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.expiration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_valid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_valid" value="0">
                    <input class="form-check-input" type="checkbox" name="is_valid" id="is_valid" value="1" {{ old('is_valid', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_valid">{{ trans('cruds.documentation.fields.is_valid') }}</label>
                </div>
                @if($errors->has('is_valid'))
                    <span class="text-danger">{{ $errors->first('is_valid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.is_valid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file">{{ trans('cruds.documentation.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.documentation.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.documentation.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.documentation.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.documentation.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_roles">{{ trans('cruds.documentation.fields.authorized_roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_roles') ? 'is-invalid' : '' }}" name="authorized_roles[]" id="authorized_roles" multiple>
                    @foreach($authorized_roles as $id => $authorized_role)
                        <option value="{{ $id }}" {{ in_array($id, old('authorized_roles', [])) ? 'selected' : '' }}>{{ $authorized_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_roles'))
                    <span class="text-danger">{{ $errors->first('authorized_roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.authorized_roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_users">{{ trans('cruds.documentation.fields.authorized_users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_users') ? 'is-invalid' : '' }}" name="authorized_users[]" id="authorized_users" multiple>
                    @foreach($authorized_users as $id => $authorized_user)
                        <option value="{{ $id }}" {{ in_array($id, old('authorized_users', [])) ? 'selected' : '' }}>{{ $authorized_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_users'))
                    <span class="text-danger">{{ $errors->first('authorized_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.documentation.fields.authorized_users_helper') }}</span>
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
    Dropzone.options.fileDropzone = {
    url: '{{ route('admin.documentations.storeMedia') }}',
    maxFilesize: 20, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').find('input[name="file"]').remove()
      $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($documentation) && $documentation->file)
      var file = {!! json_encode($documentation->file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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