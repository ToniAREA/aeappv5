@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.clients.update", [$client->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="has_active_vip_plan" value="0">
                                <input type="checkbox" name="has_active_vip_plan" id="has_active_vip_plan" value="1" {{ $client->has_active_vip_plan || old('has_active_vip_plan', 0) === 1 ? 'checked' : '' }}>
                                <label for="has_active_vip_plan">{{ trans('cruds.client.fields.has_active_vip_plan') }}</label>
                            </div>
                            @if($errors->has('has_active_vip_plan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('has_active_vip_plan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.has_active_vip_plan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="has_active_maintenance_plan" value="0">
                                <input type="checkbox" name="has_active_maintenance_plan" id="has_active_maintenance_plan" value="1" {{ $client->has_active_maintenance_plan || old('has_active_maintenance_plan', 0) === 1 ? 'checked' : '' }}>
                                <label for="has_active_maintenance_plan">{{ trans('cruds.client.fields.has_active_maintenance_plan') }}</label>
                            </div>
                            @if($errors->has('has_active_maintenance_plan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('has_active_maintenance_plan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.has_active_maintenance_plan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="defaulter" value="0">
                                <input type="checkbox" name="defaulter" id="defaulter" value="1" {{ $client->defaulter || old('defaulter', 0) === 1 ? 'checked' : '' }}>
                                <label for="defaulter">{{ trans('cruds.client.fields.defaulter') }}</label>
                            </div>
                            @if($errors->has('defaulter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('defaulter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.defaulter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ref">{{ trans('cruds.client.fields.ref') }}</label>
                            <input class="form-control" type="text" name="ref" id="ref" value="{{ old('ref', $client->ref) }}">
                            @if($errors->has('ref'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ref') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.ref_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $client->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">{{ trans('cruds.client.fields.lastname') }}</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old('lastname', $client->lastname) }}">
                            @if($errors->has('lastname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.lastname_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="vat">{{ trans('cruds.client.fields.vat') }}</label>
                            <input class="form-control" type="text" name="vat" id="vat" value="{{ old('vat', $client->vat) }}">
                            @if($errors->has('vat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.vat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.client.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $client->address) }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="country">{{ trans('cruds.client.fields.country') }}</label>
                            <input class="form-control" type="text" name="country" id="country" value="{{ old('country', $client->country) }}">
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="telephone">{{ trans('cruds.client.fields.telephone') }}</label>
                            <input class="form-control" type="text" name="telephone" id="telephone" value="{{ old('telephone', $client->telephone) }}">
                            @if($errors->has('telephone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telephone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.telephone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">{{ trans('cruds.client.fields.mobile') }}</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', $client->mobile) }}">
                            @if($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ old('email', $client->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contacts">{{ trans('cruds.client.fields.contacts') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="contacts[]" id="contacts" multiple>
                                @foreach($contacts as $id => $contact)
                                    <option value="{{ $id }}" {{ (in_array($id, old('contacts', [])) || $client->contacts->contains($id)) ? 'selected' : '' }}>{{ $contact }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('contacts'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contacts') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.contacts_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="boats">{{ trans('cruds.client.fields.boats') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="boats[]" id="boats" multiple>
                                @foreach($boats as $id => $boat)
                                    <option value="{{ $id }}" {{ (in_array($id, old('boats', [])) || $client->boats->contains($id)) ? 'selected' : '' }}>{{ $boat }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boats'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boats') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.boats_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.client.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $client->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.client.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $client->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="coordinates">{{ trans('cruds.client.fields.coordinates') }}</label>
                            <input class="form-control" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $client->coordinates) }}">
                            @if($errors->has('coordinates'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('coordinates') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.coordinates_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a">{{ trans('cruds.client.fields.link_a') }}</label>
                            <input class="form-control" type="text" name="link_a" id="link_a" value="{{ old('link_a', $client->link_a) }}">
                            @if($errors->has('link_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_a_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a_description">{{ trans('cruds.client.fields.link_a_description') }}</label>
                            <input class="form-control" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', $client->link_a_description) }}">
                            @if($errors->has('link_a_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_a_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b">{{ trans('cruds.client.fields.link_b') }}</label>
                            <input class="form-control" type="text" name="link_b" id="link_b" value="{{ old('link_b', $client->link_b) }}">
                            @if($errors->has('link_b'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_b_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b_description">{{ trans('cruds.client.fields.link_b_description') }}</label>
                            <input class="form-control" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', $client->link_b_description) }}">
                            @if($errors->has('link_b_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.link_b_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_use">{{ trans('cruds.client.fields.last_use') }}</label>
                            <input class="form-control datetime" type="text" name="last_use" id="last_use" value="{{ old('last_use', $client->last_use) }}">
                            @if($errors->has('last_use'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_use') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.last_use_helper') }}</span>
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