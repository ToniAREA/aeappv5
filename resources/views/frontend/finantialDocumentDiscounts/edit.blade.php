@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.finantialDocumentDiscount.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.finantial-document-discounts.update", [$finantialDocumentDiscount->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="item_id">{{ trans('cruds.finantialDocumentDiscount.fields.item') }}</label>
                            <select class="form-control select2" name="item_id" id="item_id">
                                @foreach($items as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('item_id') ? old('item_id') : $finantialDocumentDiscount->item->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('item'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('item') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="type">{{ trans('cruds.finantialDocumentDiscount.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', $finantialDocumentDiscount->type) }}">
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="discount_rate">{{ trans('cruds.finantialDocumentDiscount.fields.discount_rate') }}</label>
                            <input class="form-control" type="number" name="discount_rate" id="discount_rate" value="{{ old('discount_rate', $finantialDocumentDiscount->discount_rate) }}" step="0.01">
                            @if($errors->has('discount_rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount_rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finantialDocumentDiscount.fields.discount_rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="discount_amount">{{ trans('cruds.finantialDocumentDiscount.fields.discount_amount') }}</label>
                            <input class="form-control" type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $finantialDocumentDiscount->discount_amount) }}" step="0.01">
                            @if($errors->has('discount_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discount_amount') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection