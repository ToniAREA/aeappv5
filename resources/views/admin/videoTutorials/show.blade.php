@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.videoTutorial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.video-tutorials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.id') }}
                        </th>
                        <td>
                            {{ $videoTutorial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.title') }}
                        </th>
                        <td>
                            {{ $videoTutorial->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.show_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $videoTutorial->show_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.description') }}
                        </th>
                        <td>
                            {{ $videoTutorial->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.image') }}
                        </th>
                        <td>
                            @if($videoTutorial->image)
                                <a href="{{ $videoTutorial->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $videoTutorial->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.video_url') }}
                        </th>
                        <td>
                            {{ $videoTutorial->video_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videoTutorial.fields.subjects') }}
                        </th>
                        <td>
                            @foreach($videoTutorial->subjects as $key => $subjects)
                                <span class="label label-info">{{ $subjects->subject }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.video-tutorials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection