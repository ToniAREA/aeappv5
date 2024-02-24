@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.assetsRental.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets-rentals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="asset_id">{{ trans('cruds.assetsRental.fields.asset') }}</label>
                <select class="form-control select2 {{ $errors->has('asset') ? 'is-invalid' : '' }}" name="asset_id" id="asset_id">
                    @foreach($assets as $id => $entry)
                        <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset'))
                    <span class="text-danger">{{ $errors->first('asset') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.asset_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.assetsRental.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_id">{{ trans('cruds.assetsRental.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id">
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_id">{{ trans('cruds.assetsRental.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id">
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.assetsRental.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.assetsRental.fields.end_date') }}</label>
                <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', '') }}" required>
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rental_details">{{ trans('cruds.assetsRental.fields.rental_details') }}</label>
                <input class="form-control {{ $errors->has('rental_details') ? 'is-invalid' : '' }}" type="text" name="rental_details" id="rental_details" value="{{ old('rental_details', '') }}">
                @if($errors->has('rental_details'))
                    <span class="text-danger">{{ $errors->first('rental_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_details_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.assetsRental.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invoiced') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invoiced" value="0">
                    <input class="form-check-input" type="checkbox" name="invoiced" id="invoiced" value="1" {{ old('invoiced', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invoiced">{{ trans('cruds.assetsRental.fields.invoiced') }}</label>
                </div>
                @if($errors->has('invoiced'))
                    <span class="text-danger">{{ $errors->first('invoiced') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.invoiced_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="proforma_id">{{ trans('cruds.assetsRental.fields.proforma') }}</label>
                <select class="form-control select2 {{ $errors->has('proforma') ? 'is-invalid' : '' }}" name="proforma_id" id="proforma_id">
                    @foreach($proformas as $id => $entry)
                        <option value="{{ $id }}" {{ old('proforma_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('proforma'))
                    <span class="text-danger">{{ $errors->first('proforma') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.proforma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.assetsRental.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_description">{{ trans('cruds.assetsRental.fields.link_description') }}</label>
                <input class="form-control {{ $errors->has('link_description') ? 'is-invalid' : '' }}" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                @if($errors->has('link_description'))
                    <span class="text-danger">{{ $errors->first('link_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.link_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.assetsRental.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                @if($errors->has('completed_at'))
                    <span class="text-danger">{{ $errors->first('completed_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.assetsRental.fields.rental_unit') }}</label>
                <select class="form-control {{ $errors->has('rental_unit') ? 'is-invalid' : '' }}" name="rental_unit" id="rental_unit" required>
                    <option value disabled {{ old('rental_unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AssetsRental::RENTAL_UNIT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rental_unit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('rental_unit'))
                    <span class="text-danger">{{ $errors->first('rental_unit') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rental_quantity">{{ trans('cruds.assetsRental.fields.rental_quantity') }}</label>
                <input class="form-control {{ $errors->has('rental_quantity') ? 'is-invalid' : '' }}" type="number" name="rental_quantity" id="rental_quantity" value="{{ old('rental_quantity', '') }}" step="1" required>
                @if($errors->has('rental_quantity'))
                    <span class="text-danger">{{ $errors->first('rental_quantity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_quantity_helper') }}</span>
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