@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.proforma.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.proformas.update", [$proforma->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="proforma_number">{{ trans('cruds.proforma.fields.proforma_number') }}</label>
                            <input class="form-control" type="text" name="proforma_number" id="proforma_number" value="{{ old('proforma_number', $proforma->proforma_number) }}" required>
                            @if($errors->has('proforma_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('proforma_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.proforma_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="closed_and_protected" value="0">
                                <input type="checkbox" name="closed_and_protected" id="closed_and_protected" value="1" {{ $proforma->closed_and_protected || old('closed_and_protected', 0) === 1 ? 'checked' : '' }}>
                                <label for="closed_and_protected">{{ trans('cruds.proforma.fields.closed_and_protected') }}</label>
                            </div>
                            @if($errors->has('closed_and_protected'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('closed_and_protected') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.closed_and_protected_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="invoice_link">{{ trans('cruds.proforma.fields.invoice_link') }}</label>
                            <input class="form-control" type="text" name="invoice_link" id="invoice_link" value="{{ old('invoice_link', $proforma->invoice_link) }}">
                            @if($errors->has('invoice_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoice_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.invoice_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.proforma.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $proforma->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boats">{{ trans('cruds.proforma.fields.boats') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="boats[]" id="boats" multiple>
                                @foreach($boats as $id => $boat)
                                    <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $proforma->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boats'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boats') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.boats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="wlists">{{ trans('cruds.proforma.fields.wlists') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="wlists[]" id="wlists" multiple>
                                @foreach($wlists as $id => $wlist)
                                    <option value="{{ $id }}" {{ (in_array($id, old('wlists', [])) || $proforma->wlists->contains($id)) ? 'selected' : '' }}>{{ $wlist }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlists'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlists') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.wlists_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.proforma.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $proforma->date) }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.proforma.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $proforma->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.proforma.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $proforma->total_amount) }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="currency">{{ trans('cruds.proforma.fields.currency') }}</label>
                            <input class="form-control" type="text" name="currency" id="currency" value="{{ old('currency', $proforma->currency) }}">
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('currency') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.currency_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="sent" value="0">
                                <input type="checkbox" name="sent" id="sent" value="1" {{ $proforma->sent || old('sent', 0) === 1 ? 'checked' : '' }}>
                                <label for="sent">{{ trans('cruds.proforma.fields.sent') }}</label>
                            </div>
                            @if($errors->has('sent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.sent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="paid" value="0">
                                <input type="checkbox" name="paid" id="paid" value="1" {{ $proforma->paid || old('paid', 0) === 1 ? 'checked' : '' }}>
                                <label for="paid">{{ trans('cruds.proforma.fields.paid') }}</label>
                            </div>
                            @if($errors->has('paid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.paid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="claims">{{ trans('cruds.proforma.fields.claims') }}</label>
                            <input class="form-control" type="number" name="claims" id="claims" value="{{ old('claims', $proforma->claims) }}" step="1">
                            @if($errors->has('claims'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('claims') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.claims_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.proforma.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', $proforma->link) }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.proforma.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', $proforma->link_description) }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.link_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.proforma.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $proforma->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.proforma.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $proforma->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.proforma.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $proforma->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.proforma.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $proforma->completed_at) }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.proforma.fields.completed_at_helper') }}</span>
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