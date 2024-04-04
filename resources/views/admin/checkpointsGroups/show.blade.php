@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.checkpointsGroup.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointsGroup.fields.id') }}
                        </th>
                        <td>
                            {{ $checkpointsGroup->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointsGroup.fields.is_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $checkpointsGroup->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointsGroup.fields.group') }}
                        </th>
                        <td>
                            {{ $checkpointsGroup->group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointsGroup.fields.description') }}
                        </th>
                        <td>
                            {{ $checkpointsGroup->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointsGroup.fields.photo') }}
                        </th>
                        <td>
                            @if($checkpointsGroup->photo)
                                <a href="{{ $checkpointsGroup->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $checkpointsGroup->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints-groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#group_checkpoints" role="tab" data-toggle="tab">
                {{ trans('cruds.checkpoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="group_checkpoints">
            @includeIf('admin.checkpointsGroups.relationships.groupCheckpoints', ['checkpoints' => $checkpointsGroup->groupCheckpoints])
        </div>
    </div>
</div>

@endsection