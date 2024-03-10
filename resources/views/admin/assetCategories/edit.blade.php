@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.assetCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.asset-categories.update", [$assetCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.assetCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $assetCategory->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetCategory.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.assetCategory.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $assetCategory->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetCategory.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_roles">{{ trans('cruds.assetCategory.fields.authorized_roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_roles') ? 'is-invalid' : '' }}" name="authorized_roles[]" id="authorized_roles" multiple>
                    @foreach($authorized_roles as $id => $authorized_role)
                        <option value="{{ $id }}" {{ (in_array($id, old('authorized_roles', [])) || $assetCategory->authorized_roles->contains($id)) ? 'selected' : '' }}>{{ $authorized_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_roles'))
                    <span class="text-danger">{{ $errors->first('authorized_roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetCategory.fields.authorized_roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_users">{{ trans('cruds.assetCategory.fields.authorized_users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_users') ? 'is-invalid' : '' }}" name="authorized_users[]" id="authorized_users" multiple>
                    @foreach($authorized_users as $id => $authorized_user)
                        <option value="{{ $id }}" {{ (in_array($id, old('authorized_users', [])) || $assetCategory->authorized_users->contains($id)) ? 'selected' : '' }}>{{ $authorized_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_users'))
                    <span class="text-danger">{{ $errors->first('authorized_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetCategory.fields.authorized_users_helper') }}</span>
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