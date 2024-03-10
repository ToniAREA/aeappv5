@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.assetsRental.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.assets-rentals.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="asset_id">{{ trans('cruds.assetsRental.fields.asset') }}</label>
                            <select class="form-control select2" name="asset_id" id="asset_id">
                                @foreach($assets as $id => $entry)
                                    <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.asset_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.assetsRental.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="client_id">{{ trans('cruds.assetsRental.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id">
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boat_id">{{ trans('cruds.assetsRental.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id">
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_date">{{ trans('cruds.assetsRental.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_date">{{ trans('cruds.assetsRental.fields.end_date') }}</label>
                            <input class="form-control" type="text" name="end_date" id="end_date" value="{{ old('end_date', '') }}" required>
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="rental_details">{{ trans('cruds.assetsRental.fields.rental_details') }}</label>
                            <input class="form-control" type="text" name="rental_details" id="rental_details" value="{{ old('rental_details', '') }}">
                            @if($errors->has('rental_details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rental_details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 ? 'checked' : '' }}>
                                <label for="active">{{ trans('cruds.assetsRental.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="invoiced" value="0">
                                <input type="checkbox" name="invoiced" id="invoiced" value="1" {{ old('invoiced', 0) == 1 ? 'checked' : '' }}>
                                <label for="invoiced">{{ trans('cruds.assetsRental.fields.invoiced') }}</label>
                            </div>
                            @if($errors->has('invoiced'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('invoiced') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.invoiced_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link">{{ trans('cruds.assetsRental.fields.link') }}</label>
                            <input class="form-control" type="text" name="link" id="link" value="{{ old('link', '') }}">
                            @if($errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_description">{{ trans('cruds.assetsRental.fields.link_description') }}</label>
                            <input class="form-control" type="text" name="link_description" id="link_description" value="{{ old('link_description', '') }}">
                            @if($errors->has('link_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.link_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.assetsRental.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.completed_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.assetsRental.fields.rental_unit') }}</label>
                            <select class="form-control" name="rental_unit" id="rental_unit" required>
                                <option value disabled {{ old('rental_unit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AssetsRental::RENTAL_UNIT_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('rental_unit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('rental_unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rental_unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="rental_quantity">{{ trans('cruds.assetsRental.fields.rental_quantity') }}</label>
                            <input class="form-control" type="number" name="rental_quantity" id="rental_quantity" value="{{ old('rental_quantity', '') }}" step="1" required>
                            @if($errors->has('rental_quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rental_quantity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.rental_quantity_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="financial_document_id">{{ trans('cruds.assetsRental.fields.financial_document') }}</label>
                            <select class="form-control select2" name="financial_document_id" id="financial_document_id">
                                @foreach($financial_documents as $id => $entry)
                                    <option value="{{ $id }}" {{ old('financial_document_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('financial_document'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('financial_document') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetsRental.fields.financial_document_helper') }}</span>
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