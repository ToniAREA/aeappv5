@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.assetsHistory.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.assets-histories.update', [$assetsHistory->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.assetsHistory.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', $assetsHistory->notes) }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.assetsHistory.fields.notes_helper') }}</span>
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
