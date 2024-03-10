@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.checkpointsGroup.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.checkpoints-groups.update", [$checkpointsGroup->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="group">{{ trans('cruds.checkpointsGroup.fields.group') }}</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', $checkpointsGroup->group) }}" required>
                @if($errors->has('group'))
                    <span class="text-danger">{{ $errors->first('group') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.checkpointsGroup.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.checkpointsGroup.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $checkpointsGroup->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.checkpointsGroup.fields.description_helper') }}</span>
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