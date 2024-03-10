@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.documentationCategory.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.documentation-categories.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.documentationCategory.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.documentationCategory.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.documentationCategory.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.documentationCategory.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="authorized_roles">{{ trans('cruds.documentationCategory.fields.authorized_roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="authorized_roles[]" id="authorized_roles" multiple>
                                @foreach($authorized_roles as $id => $authorized_role)
                                    <option value="{{ $id }}" {{ in_array($id, old('authorized_roles', [])) ? 'selected' : '' }}>{{ $authorized_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('authorized_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('authorized_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.documentationCategory.fields.authorized_roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="authorized_users">{{ trans('cruds.documentationCategory.fields.authorized_users') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="authorized_users[]" id="authorized_users" multiple>
                                @foreach($authorized_users as $id => $authorized_user)
                                    <option value="{{ $id }}" {{ in_array($id, old('authorized_users', [])) ? 'selected' : '' }}>{{ $authorized_user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('authorized_users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('authorized_users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.documentationCategory.fields.authorized_users_helper') }}</span>
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