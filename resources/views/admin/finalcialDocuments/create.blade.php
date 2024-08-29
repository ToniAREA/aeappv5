@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.finalcialDocument.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.finalcial-documents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</label>
                @foreach(App\Models\FinalcialDocument::DOC_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('doc_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="doc_type_{{ $key }}" name="doc_type" value="{{ $key }}" {{ old('doc_type', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('doc_type'))
                    <span class="text-danger">{{ $errors->first('doc_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.doc_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference_number">{{ trans('cruds.finalcialDocument.fields.reference_number') }}</label>
                <input class="form-control {{ $errors->has('reference_number') ? 'is-invalid' : '' }}" type="text" name="reference_number" id="reference_number" value="{{ old('reference_number', '') }}">
                @if($errors->has('reference_number'))
                    <span class="text-danger">{{ $errors->first('reference_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.reference_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.finalcialDocument.fields.status') }}</label>
                @foreach(App\Models\FinalcialDocument::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.finalcialDocument.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="issue_date">{{ trans('cruds.finalcialDocument.fields.issue_date') }}</label>
                <input class="form-control date {{ $errors->has('issue_date') ? 'is-invalid' : '' }}" type="text" name="issue_date" id="issue_date" value="{{ old('issue_date') }}">
                @if($errors->has('issue_date'))
                    <span class="text-danger">{{ $errors->first('issue_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.issue_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="due_date">{{ trans('cruds.finalcialDocument.fields.due_date') }}</label>
                <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="text" name="due_date" id="due_date" value="{{ old('due_date') }}">
                @if($errors->has('due_date'))
                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.due_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="currency_id">{{ trans('cruds.finalcialDocument.fields.currency') }}</label>
                <select class="form-control select2 {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency_id" id="currency_id">
                    @foreach($currencies as $id => $entry)
                        <option value="{{ $id }}" {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subtotal">{{ trans('cruds.finalcialDocument.fields.subtotal') }}</label>
                <input class="form-control {{ $errors->has('subtotal') ? 'is-invalid' : '' }}" type="number" name="subtotal" id="subtotal" value="{{ old('subtotal', '') }}" step="0.01">
                @if($errors->has('subtotal'))
                    <span class="text-danger">{{ $errors->first('subtotal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.subtotal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_taxes">{{ trans('cruds.finalcialDocument.fields.total_taxes') }}</label>
                <input class="form-control {{ $errors->has('total_taxes') ? 'is-invalid' : '' }}" type="number" name="total_taxes" id="total_taxes" value="{{ old('total_taxes', '') }}" step="0.01">
                @if($errors->has('total_taxes'))
                    <span class="text-danger">{{ $errors->first('total_taxes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.total_taxes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_discounts">{{ trans('cruds.finalcialDocument.fields.total_discounts') }}</label>
                <input class="form-control {{ $errors->has('total_discounts') ? 'is-invalid' : '' }}" type="number" name="total_discounts" id="total_discounts" value="{{ old('total_discounts', '') }}" step="0.01">
                @if($errors->has('total_discounts'))
                    <span class="text-danger">{{ $errors->first('total_discounts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.total_discounts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.finalcialDocument.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_terms">{{ trans('cruds.finalcialDocument.fields.payment_terms') }}</label>
                <input class="form-control {{ $errors->has('payment_terms') ? 'is-invalid' : '' }}" type="text" name="payment_terms" id="payment_terms" value="{{ old('payment_terms', '') }}">
                @if($errors->has('payment_terms'))
                    <span class="text-danger">{{ $errors->first('payment_terms') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.payment_terms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="security_code">{{ trans('cruds.finalcialDocument.fields.security_code') }}</label>
                <input class="form-control {{ $errors->has('security_code') ? 'is-invalid' : '' }}" type="text" name="security_code" id="security_code" value="{{ old('security_code', '') }}">
                @if($errors->has('security_code'))
                    <span class="text-danger">{{ $errors->first('security_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.security_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.finalcialDocument.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.notes_helper') }}</span>
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