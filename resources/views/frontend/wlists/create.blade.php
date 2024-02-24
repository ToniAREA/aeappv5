@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.wlist.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.wlists.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.wlist.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.wlist.fields.order_type') }}</label>
                            @foreach(App\Models\Wlist::ORDER_TYPE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="order_type_{{ $key }}" name="order_type" value="{{ $key }}" {{ old('order_type', '') === (string) $key ? 'checked' : '' }} required>
                                    <label for="order_type_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('order_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('order_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.order_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="boat_id">{{ trans('cruds.wlist.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id" required>
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="from_user_id">{{ trans('cruds.wlist.fields.from_user') }}</label>
                            <select class="form-control select2" name="from_user_id" id="from_user_id">
                                @foreach($from_users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('from_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('from_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from_user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.from_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_roles">{{ trans('cruds.wlist.fields.for_role') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="for_roles[]" id="for_roles" multiple>
                                @foreach($for_roles as $id => $for_role)
                                    <option value="{{ $id }}" {{ in_array($id, old('for_roles', [])) ? 'selected' : '' }}>{{ $for_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.for_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_employee_id">{{ trans('cruds.wlist.fields.for_employee') }}</label>
                            <select class="form-control select2" name="for_employee_id" id="for_employee_id">
                                @foreach($for_employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('for_employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.for_employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.wlist.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', '') }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.wlist.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="estimated_hours">{{ trans('cruds.wlist.fields.estimated_hours') }}</label>
                            <input class="form-control" type="number" name="estimated_hours" id="estimated_hours" value="{{ old('estimated_hours', '') }}" step="0.01">
                            @if($errors->has('estimated_hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estimated_hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.estimated_hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.wlist.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.photos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="deadline">{{ trans('cruds.wlist.fields.deadline') }}</label>
                            <input class="form-control date" type="text" name="deadline" id="deadline" value="{{ old('deadline') }}">
                            @if($errors->has('deadline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deadline') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.deadline_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.wlist.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority">{{ trans('cruds.wlist.fields.priority') }}</label>
                            <input class="form-control" type="number" name="priority" id="priority" value="{{ old('priority', '') }}" step="1">
                            @if($errors->has('priority'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.priority_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_link">{{ trans('cruds.wlist.fields.proforma_link') }}</label>
                            <input class="form-control" type="text" name="proforma_link" id="proforma_link" value="{{ old('proforma_link', '') }}">
                            @if($errors->has('proforma_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.proforma_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.wlist.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.wlist.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.wlist.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.wlist.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.link_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_use">{{ trans('cruds.wlist.fields.last_use') }}</label>
                            <input class="form-control datetime" type="text" name="last_use" id="last_use" value="{{ old('last_use') }}">
                            @if($errors->has('last_use'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_use') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.last_use_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.wlist.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.wlist.fields.completed_at_helper') }}</span>
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
    url: '{{ route('frontend.wlists.storeMedia') }}',
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
@if(isset($wlist) && $wlist->photos)
      var files = {!! json_encode($wlist->photos) !!}
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