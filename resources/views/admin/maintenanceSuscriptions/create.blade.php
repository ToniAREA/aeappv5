@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.maintenanceSuscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.maintenance-suscriptions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.maintenanceSuscription.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.maintenanceSuscription.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.maintenanceSuscription.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="boats">{{ trans('cruds.maintenanceSuscription.fields.boats') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('boats') ? 'is-invalid' : '' }}" name="boats[]" id="boats" multiple required>
                    @foreach($boats as $id => $boat)
                        <option value="{{ $id }}" {{ in_array($id, old('boats', [])) ? 'selected' : '' }}>{{ $boat }}</option>
                    @endforeach
                </select>
                @if($errors->has('boats'))
                    <span class="text-danger">{{ $errors->first('boats') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.boats_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="care_plan_id">{{ trans('cruds.maintenanceSuscription.fields.care_plan') }}</label>
                <select class="form-control select2 {{ $errors->has('care_plan') ? 'is-invalid' : '' }}" name="care_plan_id" id="care_plan_id" required>
                    @foreach($care_plans as $id => $entry)
                        <option value="{{ $id }}" {{ old('care_plan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('care_plan'))
                    <span class="text-danger">{{ $errors->first('care_plan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.care_plan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="signed_contract">{{ trans('cruds.maintenanceSuscription.fields.signed_contract') }}</label>
                <div class="needsclick dropzone {{ $errors->has('signed_contract') ? 'is-invalid' : '' }}" id="signed_contract-dropzone">
                </div>
                @if($errors->has('signed_contract'))
                    <span class="text-danger">{{ $errors->first('signed_contract') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.signed_contract_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.maintenanceSuscription.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.maintenanceSuscription.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate_discount">{{ trans('cruds.maintenanceSuscription.fields.hourly_rate_discount') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate_discount') ? 'is-invalid' : '' }}" type="number" name="hourly_rate_discount" id="hourly_rate_discount" value="{{ old('hourly_rate_discount', '') }}" step="0.01">
                @if($errors->has('hourly_rate_discount'))
                    <span class="text-danger">{{ $errors->first('hourly_rate_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.hourly_rate_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="material_discount">{{ trans('cruds.maintenanceSuscription.fields.material_discount') }}</label>
                <input class="form-control {{ $errors->has('material_discount') ? 'is-invalid' : '' }}" type="number" name="material_discount" id="material_discount" value="{{ old('material_discount', '') }}" step="0.01">
                @if($errors->has('material_discount'))
                    <span class="text-danger">{{ $errors->first('material_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.material_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.maintenanceSuscription.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.maintenanceSuscription.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.maintenanceSuscription.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.maintenanceSuscription.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.internalnotes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.maintenanceSuscription.fields.completed_at') }}</label>
                <input class="form-control date {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                @if($errors->has('completed_at'))
                    <span class="text-danger">{{ $errors->first('completed_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="financial_document_id">{{ trans('cruds.maintenanceSuscription.fields.financial_document') }}</label>
                <select class="form-control select2 {{ $errors->has('financial_document') ? 'is-invalid' : '' }}" name="financial_document_id" id="financial_document_id">
                    @foreach($financial_documents as $id => $entry)
                        <option value="{{ $id }}" {{ old('financial_document_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('financial_document'))
                    <span class="text-danger">{{ $errors->first('financial_document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.maintenanceSuscription.fields.financial_document_helper') }}</span>
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
    url: '{{ route('admin.maintenance-suscriptions.storeMedia') }}',
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
@if(isset($maintenanceSuscription) && $maintenanceSuscription->signed_contract)
      var file = {!! json_encode($maintenanceSuscription->signed_contract) !!}
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