@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.finantialDocumentDiscount.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.finantial-document-discounts.update", [$finantialDocumentDiscount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="item_id">{{ trans('cruds.finantialDocumentDiscount.fields.item') }}</label>
                <select class="form-control select2 {{ $errors->has('item') ? 'is-invalid' : '' }}" name="item_id" id="item_id">
                    @foreach($items as $id => $entry)
                        <option value="{{ $id }}" {{ (old('item_id') ? old('item_id') : $finantialDocumentDiscount->item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                    <span class="text-danger">{{ $errors->first('item') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.finantialDocumentDiscount.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $finantialDocumentDiscount->type) }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount_rate">{{ trans('cruds.finantialDocumentDiscount.fields.discount_rate') }}</label>
                <input class="form-control {{ $errors->has('discount_rate') ? 'is-invalid' : '' }}" type="number" name="discount_rate" id="discount_rate" value="{{ old('discount_rate', $finantialDocumentDiscount->discount_rate) }}" step="0.01">
                @if($errors->has('discount_rate'))
                    <span class="text-danger">{{ $errors->first('discount_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.discount_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount_amount">{{ trans('cruds.finantialDocumentDiscount.fields.discount_amount') }}</label>
                <input class="form-control {{ $errors->has('discount_amount') ? 'is-invalid' : '' }}" type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $finantialDocumentDiscount->discount_amount) }}" step="0.01">
                @if($errors->has('discount_amount'))
                    <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.discount_amount_helper') }}</span>
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