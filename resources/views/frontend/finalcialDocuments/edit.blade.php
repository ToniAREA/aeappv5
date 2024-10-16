@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.finalcialDocument.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('frontend.finalcial-documents.update', [$finalcialDocument->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</label>
                                @foreach (App\Models\FinalcialDocument::DOC_TYPE_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="doc_type_{{ $key }}" name="doc_type"
                                            value="{{ $key }}"
                                            {{ old('doc_type', $finalcialDocument->doc_type) === (string) $key ? 'checked' : '' }}>
                                        <label for="doc_type_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('doc_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('doc_type') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.doc_type_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="reference_number">{{ trans('cruds.finalcialDocument.fields.reference_number') }}</label>
                                <input class="form-control" type="text" name="reference_number" id="reference_number"
                                    value="{{ old('reference_number', $finalcialDocument->reference_number) }}">
                                @if ($errors->has('reference_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('reference_number') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.reference_number_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.finalcialDocument.fields.status') }}</label>
                                @foreach (App\Models\FinalcialDocument::STATUS_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="status_{{ $key }}" name="status"
                                            value="{{ $key }}"
                                            {{ old('status', $finalcialDocument->status) === (string) $key ? 'checked' : '' }}>
                                        <label for="status_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="client_id">{{ trans('cruds.finalcialDocument.fields.client') }}</label>
                                <select class="form-control select2" name="client_id" id="client_id">
                                    @foreach ($clients as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('client_id') ? old('client_id') : $finalcialDocument->client->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('client'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.finalcialDocument.fields.client_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="issue_date">{{ trans('cruds.finalcialDocument.fields.issue_date') }}</label>
                                <input class="form-control date" type="text" name="issue_date" id="issue_date"
                                    value="{{ old('issue_date', $finalcialDocument->issue_date) }}">
                                @if ($errors->has('issue_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('issue_date') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.issue_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="due_date">{{ trans('cruds.finalcialDocument.fields.due_date') }}</label>
                                <input class="form-control date" type="text" name="due_date" id="due_date"
                                    value="{{ old('due_date', $finalcialDocument->due_date) }}">
                                @if ($errors->has('due_date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('due_date') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.due_date_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="currency_id">{{ trans('cruds.finalcialDocument.fields.currency') }}</label>
                                <select class="form-control select2" name="currency_id" id="currency_id">
                                    @foreach ($currencies as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('currency_id') ? old('currency_id') : $finalcialDocument->currency->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('currency') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.currency_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="subtotal">{{ trans('cruds.finalcialDocument.fields.subtotal') }}</label>
                                <input class="form-control" type="number" name="subtotal" id="subtotal"
                                    value="{{ old('subtotal', $finalcialDocument->subtotal) }}" step="0.01">
                                @if ($errors->has('subtotal'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subtotal') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.subtotal_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="total_taxes">{{ trans('cruds.finalcialDocument.fields.total_taxes') }}</label>
                                <input class="form-control" type="number" name="total_taxes" id="total_taxes"
                                    value="{{ old('total_taxes', $finalcialDocument->total_taxes) }}" step="0.01">
                                @if ($errors->has('total_taxes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_taxes') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.total_taxes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="total_discounts">{{ trans('cruds.finalcialDocument.fields.total_discounts') }}</label>
                                <input class="form-control" type="number" name="total_discounts" id="total_discounts"
                                    value="{{ old('total_discounts', $finalcialDocument->total_discounts) }}"
                                    step="0.01">
                                @if ($errors->has('total_discounts'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_discounts') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.total_discounts_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="total_amount">{{ trans('cruds.finalcialDocument.fields.total_amount') }}</label>
                                <input class="form-control" type="number" name="total_amount" id="total_amount"
                                    value="{{ old('total_amount', $finalcialDocument->total_amount) }}" step="0.01">
                                @if ($errors->has('total_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_amount') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.total_amount_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="payment_terms">{{ trans('cruds.finalcialDocument.fields.payment_terms') }}</label>
                                <input class="form-control" type="text" name="payment_terms" id="payment_terms"
                                    value="{{ old('payment_terms', $finalcialDocument->payment_terms) }}">
                                @if ($errors->has('payment_terms'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment_terms') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.payment_terms_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="security_code">{{ trans('cruds.finalcialDocument.fields.security_code') }}</label>
                                <input class="form-control" type="text" name="security_code" id="security_code"
                                    value="{{ old('security_code', $finalcialDocument->security_code) }}">
                                @if ($errors->has('security_code'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('security_code') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.finalcialDocument.fields.security_code_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.finalcialDocument.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', $finalcialDocument->notes) }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
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

            </div>
        </div>
    </div>
@endsection
