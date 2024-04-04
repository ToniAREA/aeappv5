@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.checkpoint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.id') }}
                        </th>
                        <td>
                            {{ $checkpoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.is_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $checkpoint->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.name') }}
                        </th>
                        <td>
                            {{ $checkpoint->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.description') }}
                        </th>
                        <td>
                            {{ $checkpoint->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.group') }}
                        </th>
                        <td>
                            @foreach($checkpoint->groups as $key => $group)
                                <span class="label label-info">{{ $group->group }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.file') }}
                        </th>
                        <td>
                            @if($checkpoint->file)
                                <a href="{{ $checkpoint->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.photo') }}
                        </th>
                        <td>
                            @if($checkpoint->photo)
                                <a href="{{ $checkpoint->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $checkpoint->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.price') }}
                        </th>
                        <td>
                            {{ $checkpoint->price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
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
            <a class="nav-link" href="#checkpoints_care_plans" role="tab" data-toggle="tab">
                {{ trans('cruds.carePlan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="checkpoints_care_plans">
            @includeIf('admin.checkpoints.relationships.checkpointsCarePlans', ['carePlans' => $checkpoint->checkpointsCarePlans])
        </div>
    </div>
</div>

@endsection