@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.payments.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="payment_gateway">{{ trans('cruds.payment.fields.payment_gateway') }}</label>
                                <input class="form-control" type="text" name="payment_gateway" id="payment_gateway"
                                    value="{{ old('payment_gateway', '') }}">
                                @if ($errors->has('payment_gateway'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('payment_gateway') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.payment.fields.payment_gateway_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="id_transaction">{{ trans('cruds.payment.fields.id_transaction') }}</label>
                                <input class="form-control" type="text" name="id_transaction" id="id_transaction"
                                    value="{{ old('id_transaction', '') }}">
                                @if ($errors->has('id_transaction'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_transaction') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.payment.fields.id_transaction_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="financial_document_id">{{ trans('cruds.payment.fields.financial_document') }}</label>
                                <select class="form-control select2" name="financial_document_id"
                                    id="financial_document_id">
                                    @foreach ($financial_documents as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('financial_document_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('financial_document'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('financial_document') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.payment.fields.financial_document_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="total_amount">{{ trans('cruds.payment.fields.total_amount') }}</label>
                                <input class="form-control" type="number" name="total_amount" id="total_amount"
                                    value="{{ old('total_amount', '') }}" step="0.01">
                                @if ($errors->has('total_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_amount') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.payment.fields.total_amount_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="status">{{ trans('cruds.payment.fields.status') }}</label>
                                <input class="form-control" type="text" name="status" id="status"
                                    value="{{ old('status', '') }}">
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="currency_id">{{ trans('cruds.payment.fields.currency') }}</label>
                                <select class="form-control select2" name="currency_id" id="currency_id">
                                    @foreach ($currencies as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('currency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('currency') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.payment.fields.currency_helper') }}</span>
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
