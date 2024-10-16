@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.priority.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.priorities.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.priority.fields.name') }}</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name', '') }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.priority.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="weight">{{ trans('cruds.priority.fields.weight') }}</label>
                                <input class="form-control" type="number" name="weight" id="weight"
                                    value="{{ old('weight', '') }}" step="1">
                                @if ($errors->has('weight'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('weight') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.priority.fields.weight_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="slug">{{ trans('cruds.priority.fields.slug') }}</label>
                                <input class="form-control" type="text" name="slug" id="slug"
                                    value="{{ old('slug', '') }}">
                                @if ($errors->has('slug'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('slug') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.priority.fields.slug_helper') }}</span>
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
