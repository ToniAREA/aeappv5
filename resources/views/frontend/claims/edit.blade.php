@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.claim.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.claims.update", [$claim->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="claim_date">{{ trans('cruds.claim.fields.claim_date') }}</label>
                            <input class="form-control date" type="text" name="claim_date" id="claim_date" value="{{ old('claim_date', $claim->claim_date) }}">
                            @if($errors->has('claim_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('claim_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.claim.fields.claim_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="note">{{ trans('cruds.claim.fields.note') }}</label>
                            <input class="form-control" type="text" name="note" id="note" value="{{ old('note', $claim->note) }}">
                            @if($errors->has('note'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('note') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.claim.fields.note_helper') }}</span>
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