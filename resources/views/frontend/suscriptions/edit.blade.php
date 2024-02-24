@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.suscription.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.suscriptions.update", [$suscription->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.suscription.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $suscription->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $suscription->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_active">{{ trans('cruds.suscription.fields.is_active') }}</label>
                            </div>
                            @if($errors->has('is_active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.is_active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="proforma_id">{{ trans('cruds.suscription.fields.proforma') }}</label>
                            <select class="form-control select2" name="proforma_id" id="proforma_id">
                                @foreach($proformas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('proforma_id') ? old('proforma_id') : $suscription->proforma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('proforma'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.proforma_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.suscription.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $suscription->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="plan_name">{{ trans('cruds.suscription.fields.plan_name') }}</label>
                            <input class="form-control" type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', $suscription->plan_name) }}">
                            @if($errors->has('plan_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('plan_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.plan_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contract">{{ trans('cruds.suscription.fields.contract') }}</label>
                            <div class="needsclick dropzone" id="contract-dropzone">
                            </div>
                            @if($errors->has('contract'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contract') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.contract_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_date">{{ trans('cruds.suscription.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $suscription->start_date) }}">
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_date">{{ trans('cruds.suscription.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $suscription->end_date) }}">
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hourly_rate_discount">{{ trans('cruds.suscription.fields.hourly_rate_discount') }}</label>
                            <input class="form-control" type="number" name="hourly_rate_discount" id="hourly_rate_discount" value="{{ old('hourly_rate_discount', $suscription->hourly_rate_discount) }}" step="0.01">
                            @if($errors->has('hourly_rate_discount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hourly_rate_discount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.hourly_rate_discount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="material_discount">{{ trans('cruds.suscription.fields.material_discount') }}</label>
                            <input class="form-control" type="number" name="material_discount" id="material_discount" value="{{ old('material_discount', $suscription->material_discount) }}" step="0.01">
                            @if($errors->has('material_discount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('material_discount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.material_discount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.suscription.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', $suscription->link) }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.suscription.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', $suscription->link_description) }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.suscription.fields.link_description_helper') }}</span>
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
    Dropzone.options.contractDropzone = {
    url: '{{ route('frontend.suscriptions.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="contract"]').remove()
      $('form').append('<input type="hidden" name="contract" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="contract"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($suscription) && $suscription->contract)
      var file = {!! json_encode($suscription->contract) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="contract" value="' + file.file_name + '">')
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