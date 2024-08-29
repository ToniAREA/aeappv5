@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.iotSuscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.iot-suscriptions.update", [$iotSuscription->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.iotSuscription.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $iotSuscription->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $iotSuscription->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.iotSuscription.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.iotSuscription.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $iotSuscription->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boats">{{ trans('cruds.iotSuscription.fields.boats') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats') ? 'is-invalid' : '' }}" name="boats[]" id="boats" multiple>
                    @foreach($boats as $id => $boat)
                        <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $iotSuscription->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats'))
                    <span class="text-danger">{{ $errors->first('boats') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.boats_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="plan_id">{{ trans('cruds.iotSuscription.fields.plan') }}</label>
                <select class="form-control select2 {{ $errors->has('plan') ? 'is-invalid' : '' }}" name="plan_id" id="plan_id">
                    @foreach($plans as $id => $entry)
                        <option value="{{ $id }}" {{ (old('plan_id') ? old('plan_id') : $iotSuscription->plan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('plan'))
                    <span class="text-danger">{{ $errors->first('plan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.plan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="signed_contract">{{ trans('cruds.iotSuscription.fields.signed_contract') }}</label>
                <div class="needsclick dropzone {{ $errors->has('signed_contract') ? 'is-invalid' : '' }}" id="signed_contract-dropzone">
                </div>
                @if($errors->has('signed_contract'))
                    <span class="text-danger">{{ $errors->first('signed_contract') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.signed_contract_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.iotSuscription.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $iotSuscription->start_date) }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.iotSuscription.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $iotSuscription->end_date) }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.iotSuscription.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $iotSuscription->hourly_rate) }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <span class="text-danger">{{ $errors->first('hourly_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate_discount">{{ trans('cruds.iotSuscription.fields.hourly_rate_discount') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate_discount') ? 'is-invalid' : '' }}" type="number" name="hourly_rate_discount" id="hourly_rate_discount" value="{{ old('hourly_rate_discount', $iotSuscription->hourly_rate_discount) }}" step="0.01">
                @if($errors->has('hourly_rate_discount'))
                    <span class="text-danger">{{ $errors->first('hourly_rate_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.hourly_rate_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="material_discount">{{ trans('cruds.iotSuscription.fields.material_discount') }}</label>
                <input class="form-control {{ $errors->has('material_discount') ? 'is-invalid' : '' }}" type="number" name="material_discount" id="material_discount" value="{{ old('material_discount', $iotSuscription->material_discount) }}" step="0.01">
                @if($errors->has('material_discount'))
                    <span class="text-danger">{{ $errors->first('material_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.material_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="device_id">{{ trans('cruds.iotSuscription.fields.device') }}</label>
                <select class="form-control select2 {{ $errors->has('device') ? 'is-invalid' : '' }}" name="device_id" id="device_id">
                    @foreach($devices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('device_id') ? old('device_id') : $iotSuscription->device->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('device'))
                    <span class="text-danger">{{ $errors->first('device') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.device_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.iotSuscription.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $iotSuscription->link) }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.iotSuscription.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', $iotSuscription->link_description) }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.iotSuscription.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $iotSuscription->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.iotSuscription.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $iotSuscription->internalnotes) }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.iotSuscription.fields.completed_at') }}</label>
                <input class="form-control date {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $iotSuscription->completed_at) }}">
                @if($errors->has('completed_at'))
                    <span class="text-danger">{{ $errors->first('completed_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="financial_document_id">{{ trans('cruds.iotSuscription.fields.financial_document') }}</label>
                <select class="form-control select2 {{ $errors->has('financial_document') ? 'is-invalid' : '' }}" name="financial_document_id" id="financial_document_id">
                    @foreach($financial_documents as $id => $entry)
                        <option value="{{ $id }}" {{ (old('financial_document_id') ? old('financial_document_id') : $iotSuscription->financial_document->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('financial_document'))
                    <span class="text-danger">{{ $errors->first('financial_document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotSuscription.fields.financial_document_helper') }}</span>
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
    Dropzone.options.signedContractDropzone = {
    url: '{{ route('admin.iot-suscriptions.storeMedia') }}',
    maxFilesize: 15, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').find('input[name="signed_contract"]').remove()
      $('form').append('<input type="hidden" name="signed_contract" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="signed_contract"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($iotSuscription) && $iotSuscription->signed_contract)
      var file = {!! json_encode($iotSuscription->signed_contract) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="signed_contract" value="' + file.file_name + '">')
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