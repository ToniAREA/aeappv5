@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.finantialDocumentTax.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.finantial-document-taxes.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="item_id">{{ trans('cruds.finantialDocumentTax.fields.item') }}</label>
                                <select class="form-control select2" name="item_id" id="item_id">
                                    @foreach ($items as $id => $entry)
                                        <option value="{{ $id }}" {{ old('item_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('item'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('item') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.finantialDocumentTax.fields.item_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.finantialDocumentTax.fields.tax_type') }}</label>
                                @foreach (App\Models\FinantialDocumentTax::TAX_TYPE_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="tax_type_{{ $key }}" name="tax_type"
                                            value="{{ $key }}"
                                            {{ old('tax_type', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="tax_type_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('tax_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tax_type') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_type_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tax_rate">{{ trans('cruds.finantialDocumentTax.fields.tax_rate') }}</label>
                                <input class="form-control" type="number" name="tax_rate" id="tax_rate"
                                    value="{{ old('tax_rate', '') }}" step="0.01">
                                @if ($errors->has('tax_rate'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tax_rate') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_rate_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tax_amount">{{ trans('cruds.finantialDocumentTax.fields.tax_amount') }}</label>
                                <input class="form-control" type="number" name="tax_amount" id="tax_amount"
                                    value="{{ old('tax_amount', '') }}" step="0.01">
                                @if ($errors->has('tax_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tax_amount') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finantialDocumentTax.fields.tax_amount_helper') }}</span>
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
