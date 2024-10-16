@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.financialDocumentItem.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('frontend.financial-document-items.update', [$financialDocumentItem->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label
                                    for="financial_document_id">{{ trans('cruds.financialDocumentItem.fields.financial_document') }}</label>
                                <select class="form-control select2" name="financial_document_id"
                                    id="financial_document_id">
                                    @foreach ($financial_documents as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('financial_document_id') ? old('financial_document_id') : $financialDocumentItem->financial_document->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('financial_document'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('financial_document') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.financial_document_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="product_id">{{ trans('cruds.financialDocumentItem.fields.product') }}</label>
                                <select class="form-control select2" name="product_id" id="product_id">
                                    @foreach ($products as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('product_id') ? old('product_id') : $financialDocumentItem->product->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.product_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="description">{{ trans('cruds.financialDocumentItem.fields.description') }}</label>
                                <input class="form-control" type="text" name="description" id="description"
                                    value="{{ old('description', $financialDocumentItem->description) }}">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{ trans('cruds.financialDocumentItem.fields.quantity') }}</label>
                                <input class="form-control" type="number" name="quantity" id="quantity"
                                    value="{{ old('quantity', $financialDocumentItem->quantity) }}" step="0.01">
                                @if ($errors->has('quantity'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('quantity') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.quantity_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="unit_price">{{ trans('cruds.financialDocumentItem.fields.unit_price') }}</label>
                                <input class="form-control" type="number" name="unit_price" id="unit_price"
                                    value="{{ old('unit_price', $financialDocumentItem->unit_price) }}" step="0.01">
                                @if ($errors->has('unit_price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('unit_price') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.unit_price_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="line_position">{{ trans('cruds.financialDocumentItem.fields.line_position') }}</label>
                                <input class="form-control" type="number" name="line_position" id="line_position"
                                    value="{{ old('line_position', $financialDocumentItem->line_position) }}"
                                    step="1">
                                @if ($errors->has('line_position'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('line_position') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.line_position_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="subtotal">{{ trans('cruds.financialDocumentItem.fields.subtotal') }}</label>
                                <input class="form-control" type="number" name="subtotal" id="subtotal"
                                    value="{{ old('subtotal', $financialDocumentItem->subtotal) }}" step="0.01">
                                @if ($errors->has('subtotal'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subtotal') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.subtotal_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="total_amount">{{ trans('cruds.financialDocumentItem.fields.total_amount') }}</label>
                                <input class="form-control" type="number" name="total_amount" id="total_amount"
                                    value="{{ old('total_amount', $financialDocumentItem->total_amount) }}" step="0.01">
                                @if ($errors->has('total_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_amount') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.financialDocumentItem.fields.total_amount_helper') }}</span>
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
