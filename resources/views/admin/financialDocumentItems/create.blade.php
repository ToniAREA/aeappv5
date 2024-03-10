@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.financialDocumentItem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.financial-document-items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="financial_document_id">{{ trans('cruds.financialDocumentItem.fields.financial_document') }}</label>
                <select class="form-control select2 {{ $errors->has('financial_document') ? 'is-invalid' : '' }}" name="financial_document_id" id="financial_document_id">
                    @foreach($financial_documents as $id => $entry)
                        <option value="{{ $id }}" {{ old('financial_document_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('financial_document'))
                    <span class="text-danger">{{ $errors->first('financial_document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.financial_document_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.financialDocumentItem.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.financialDocumentItem.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.financialDocumentItem.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="0.01">
                @if($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unit_price">{{ trans('cruds.financialDocumentItem.fields.unit_price') }}</label>
                <input class="form-control {{ $errors->has('unit_price') ? 'is-invalid' : '' }}" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', '') }}" step="0.01">
                @if($errors->has('unit_price'))
                    <span class="text-danger">{{ $errors->first('unit_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.unit_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="line_position">{{ trans('cruds.financialDocumentItem.fields.line_position') }}</label>
                <input class="form-control {{ $errors->has('line_position') ? 'is-invalid' : '' }}" type="number" name="line_position" id="line_position" value="{{ old('line_position', '') }}" step="1">
                @if($errors->has('line_position'))
                    <span class="text-danger">{{ $errors->first('line_position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.line_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subtotal">{{ trans('cruds.financialDocumentItem.fields.subtotal') }}</label>
                <input class="form-control {{ $errors->has('subtotal') ? 'is-invalid' : '' }}" type="number" name="subtotal" id="subtotal" value="{{ old('subtotal', '') }}" step="0.01">
                @if($errors->has('subtotal'))
                    <span class="text-danger">{{ $errors->first('subtotal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.subtotal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.financialDocumentItem.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.financialDocumentItem.fields.total_amount_helper') }}</span>
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