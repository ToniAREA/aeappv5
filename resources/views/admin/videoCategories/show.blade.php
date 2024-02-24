@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.videoCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.video-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.videoCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $videoCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoCategory.fields.subject') }}
                        </th>
                        <td>
                            {{ $videoCategory->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $videoCategory->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.video-categories.index') }}">
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
            <a class="nav-link" href="#subjects_video_tutorials" role="tab" data-toggle="tab">
                {{ trans('cruds.videoTutorial.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subjects_video_tutorials">
            @includeIf('admin.videoCategories.relationships.subjectsVideoTutorials', ['videoTutorials' => $videoCategory->subjectsVideoTutorials])
        </div>
    </div>
</div>

@endsection