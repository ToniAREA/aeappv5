@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.waitingList.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.waiting-lists.update', [$waitingList->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="user_id">{{ trans('cruds.waitingList.fields.user') }}</label>
                                <select class="form-control select2" name="user_id" id="user_id">
                                    @foreach ($users as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('user_id') ? old('user_id') : $waitingList->user->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.user_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="client_id">{{ trans('cruds.waitingList.fields.client') }}</label>
                                <select class="form-control select2" name="client_id" id="client_id">
                                    @foreach ($clients as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('client_id') ? old('client_id') : $waitingList->client->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('client'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.client_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="boats">{{ trans('cruds.waitingList.fields.boats') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="boats[]" id="boats" multiple>
                                    @foreach ($boats as $id => $boat)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('boats', [])) || $waitingList->boats->contains($id) ? 'selected' : '' }}>
                                            {{ $boat }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('boats'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('boats') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.boats_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="plan_id">{{ trans('cruds.waitingList.fields.plan') }}</label>
                                <select class="form-control select2" name="plan_id" id="plan_id">
                                    @foreach ($plans as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('plan_id') ? old('plan_id') : $waitingList->plan->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('plan'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('plan') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.plan_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="waiting_for">{{ trans('cruds.waitingList.fields.waiting_for') }}</label>
                                <input class="form-control" type="text" name="waiting_for" id="waiting_for"
                                    value="{{ old('waiting_for', $waitingList->waiting_for) }}">
                                @if ($errors->has('waiting_for'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('waiting_for') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.waiting_for_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.waitingList.fields.status') }}</label>
                                <select class="form-control" name="status" id="status">
                                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                        {{ trans('global.pleaseSelect') }}</option>
                                    @foreach (App\Models\WaitingList::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('status', $waitingList->status) === (string) $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.waitingList.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', $waitingList->notes) }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.waitingList.fields.notes_helper') }}</span>
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
