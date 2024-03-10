@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.finantialDocumentTax.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.finantial-document-taxes.update", [$finantialDocumentTax->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="item_id">{{ trans('cruds.finantialDocumentTax.fields.item') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id">
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ (old('item_id') ? old('item_id') : $finantialDocumentTax->item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <span class="text-danger">{{ $errors->first('item') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentTax.fields.item_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.finantialDocumentTax.fields.tax_type') }}</label>
                @foreach(App\Models\FinantialDocumentTax::TAX_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('tax_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="tax_type_{{ $key }}" name="tax_type" value="{{ $key }}" {{ old('tax_type', $finantialDocumentTax->tax_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="tax_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('tax_type'))
                    <span class="text-danger">{{ $errors->first('tax_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_rate">{{ trans('cruds.finantialDocumentTax.fields.tax_rate') }}</label>
                <input class="form-control {{ $errors->has('tax_rate') ? 'is-invalid' : '' }}" type="number" name="tax_rate" id="tax_rate" value="{{ old('tax_rate', $finantialDocumentTax->tax_rate) }}" step="0.01">
                @if($errors->has('tax_rate'))
                    <span class="text-danger">{{ $errors->first('tax_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax_amount">{{ trans('cruds.finantialDocumentTax.fields.tax_amount') }}</label>
                <input class="form-control {{ $errors->has('tax_amount') ? 'is-invalid' : '' }}" type="number" name="tax_amount" id="tax_amount" value="{{ old('tax_amount', $finantialDocumentTax->tax_amount) }}" step="0.01">
                @if($errors->has('tax_amount'))
                    <span class="text-danger">{{ $errors->first('tax_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_amount_helper') }}</span>
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