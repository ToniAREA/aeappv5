@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.clientsReview.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.clients-reviews.update', [$clientsReview->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="boats">{{ trans('cruds.clientsReview.fields.boats') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="boats[]" id="boats" multiple>
                                    @foreach ($boats as $id => $boat)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('boats', [])) || $clientsReview->boats->contains($id) ? 'selected' : '' }}>
                                            {{ $boat }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('boats'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('boats') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientsReview.fields.boats_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="client_id">{{ trans('cruds.clientsReview.fields.client') }}</label>
                                <select class="form-control select2" name="client_id" id="client_id">
                                    @foreach ($clients as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('client_id') ? old('client_id') : $clientsReview->client->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('client'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientsReview.fields.client_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="for_wlists">{{ trans('cruds.clientsReview.fields.for_wlists') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="for_wlists[]" id="for_wlists" multiple>
                                    @foreach ($for_wlists as $id => $for_wlist)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('for_wlists', [])) || $clientsReview->for_wlists->contains($id) ? 'selected' : '' }}>
                                            {{ $for_wlist }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('for_wlists'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('for_wlists') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientsReview.fields.for_wlists_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="rating">{{ trans('cruds.clientsReview.fields.rating') }}</label>
                                <input class="form-control" type="number" name="rating" id="rating"
                                    value="{{ old('rating', $clientsReview->rating) }}" step="0.1">
                                @if ($errors->has('rating'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('rating') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.clientsReview.fields.rating_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="shown_online" value="0">
                                    <input type="checkbox" name="shown_online" id="shown_online" value="1"
                                        {{ $clientsReview->shown_online || old('shown_online', 0) === 1 ? 'checked' : '' }}>
                                    <label
                                        for="shown_online">{{ trans('cruds.clientsReview.fields.shown_online') }}</label>
                                </div>
                                @if ($errors->has('shown_online'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('shown_online') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.clientsReview.fields.shown_online_helper') }}</span>
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
