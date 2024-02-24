@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.suscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suscriptions.update", [$suscription->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.suscription.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $suscription->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $suscription->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.suscription.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_id">{{ trans('cruds.suscription.fields.proforma') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma') ? 'is-invalid' : '' }}" name="proforma_id" id="proforma_id">
                    @foreach($proformas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('proforma_id') ? old('proforma_id') : $suscription->proforma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma'))
                    <span class="text-danger">{{ $errors->first('proforma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.proforma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.suscription.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $suscription->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plan_name">{{ trans('cruds.suscription.fields.plan_name') }}</label>
                <input class="form-control {{ $errors->has('plan_name') ? 'is-invalid' : '' }}" type="text" name="plan_name" id="plan_name" value="{{ old('plan_name', $suscription->plan_name) }}">
                @if($errors->has('plan_name'))
                    <span class="text-danger">{{ $errors->first('plan_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.plan_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contract">{{ trans('cruds.suscription.fields.contract') }}</label>
                <div class="needsclick dropzone {{ $errors->has('contract') ? 'is-invalid' : '' }}" id="contract-dropzone">
                </div>
                @if($errors->has('contract'))
                    <span class="text-danger">{{ $errors->first('contract') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.contract_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.suscription.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $suscription->start_date) }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.suscription.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $suscription->end_date) }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate_discount">{{ trans('cruds.suscription.fields.hourly_rate_discount') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate_discount') ? 'is-invalid' : '' }}" type="number" name="hourly_rate_discount" id="hourly_rate_discount" value="{{ old('hourly_rate_discount', $suscription->hourly_rate_discount) }}" step="0.01">
                @if($errors->has('hourly_rate_discount'))
                    <span class="text-danger">{{ $errors->first('hourly_rate_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.hourly_rate_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="material_discount">{{ trans('cruds.suscription.fields.material_discount') }}</label>
                <input class="form-control {{ $errors->has('material_discount') ? 'is-invalid' : '' }}" type="number" name="material_discount" id="material_discount" value="{{ old('material_discount', $suscription->material_discount) }}" step="0.01">
                @if($errors->has('material_discount'))
                    <span class="text-danger">{{ $errors->first('material_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.material_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.suscription.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $suscription->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suscription.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.suscription.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', $suscription->link_description) }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
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



@endsection

@section('scripts')
<script>
    Dropzone.options.contractDropzone = {
    url: '{{ route('admin.suscriptions.storeMedia') }}',
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