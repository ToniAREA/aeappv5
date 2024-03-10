@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.techDocsType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tech-docs-types.update", [$techDocsType->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.techDocsType.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $techDocsType->name) }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.techDocsType.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.techDocsType.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', $techDocsType->description) }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.techDocsType.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="authorized_roles">{{ trans('cruds.techDocsType.fields.authorized_roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="authorized_roles[]" id="authorized_roles" multiple>
                                @foreach($authorized_roles as $id => $authorized_role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('authorized_roles', [])) || $techDocsType->authorized_roles->contains($id)) ? 'selected' : '' }}>{{ $authorized_role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('authorized_roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('authorized_roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.techDocsType.fields.authorized_roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="authorized_users">{{ trans('cruds.techDocsType.fields.authorized_users') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="authorized_users[]" id="authorized_users" multiple>
                                @foreach($authorized_users as $id => $authorized_user)
                                    <option value="{{ $id }}" {{ (in_array($id, old('authorized_users', [])) || $techDocsType->authorized_users->contains($id)) ? 'selected' : '' }}>{{ $authorized_user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('authorized_users'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('authorized_users') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.techDocsType.fields.authorized_users_helper') }}</span>
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