@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.mlog.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.mlogs.update", [$mlog->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="boat_id">{{ trans('cruds.mlog.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id" required>
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $mlog->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_namecomplete">{{ trans('cruds.mlog.fields.boat_namecomplete') }}</label>
                            <input class="form-control" type="text" name="boat_namecomplete" id="boat_namecomplete" value="{{ old('boat_namecomplete', $mlog->boat_namecomplete) }}">
                            @if($errors->has('boat_namecomplete'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat_namecomplete') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.boat_namecomplete_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wlist_id">{{ trans('cruds.mlog.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id">
                                @foreach($wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $mlog->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.mlog.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $mlog->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.mlog.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $mlog->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="item">{{ trans('cruds.mlog.fields.item') }}</label>
                            <input class="form-control" type="text" name="item" id="item" value="{{ old('item', $mlog->item) }}">
                            @if($errors->has('item'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('item') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_id">{{ trans('cruds.mlog.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id">
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $mlog->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.mlog.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $mlog->description) }}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.mlog.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.photos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="units">{{ trans('cruds.mlog.fields.units') }}</label>
                            <input class="form-control" type="number" name="units" id="units" value="{{ old('units', $mlog->units) }}" step="0.01">
                            @if($errors->has('units'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('units') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.units_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="price_unit">{{ trans('cruds.mlog.fields.price_unit') }}</label>
                            <input class="form-control" type="number" name="price_unit" id="price_unit" value="{{ old('price_unit', $mlog->price_unit) }}" step="0.01">
                            @if($errors->has('price_unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price_unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.price_unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="invoiced_line" value="0">
                                <input type="checkbox" name="invoiced_line" id="invoiced_line" value="1" {{ $mlog->invoiced_line || old('invoiced_line', 0) === 1 ? 'checked' : '' }}>
                                <label for="invoiced_line">{{ trans('cruds.mlog.fields.invoiced_line') }}</label>
                            </div>
                            @if($errors->has('invoiced_line'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoiced_line') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.invoiced_line_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.mlog.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $mlog->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="financial_document_id">{{ trans('cruds.mlog.fields.financial_document') }}</label>
                            <select class="form-control select2" name="financial_document_id" id="financial_document_id">
                                @foreach($financial_documents as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('financial_document_id') ? old('financial_document_id') : $mlog->financial_document->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('financial_document'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('financial_document') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.mlog.fields.financial_document_helper') }}</span>
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
    url: '{{ route('frontend.mlogs.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
@if(isset($mlog) && $mlog->photos)
      var files = {!! json_encode($mlog->photos) !!}
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