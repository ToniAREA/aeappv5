@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.videoTutorial.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.video-tutorials.index') }}">
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
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $videoTutorial->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_meta_description') }}
                                    </th>
                                    <td>
                                        {{ $videoTutorial->seo_meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_slug') }}
                                    </th>
                                    <td>
                                        {{ $videoTutorial->seo_slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.authorized_roles') }}
                                    </th>
                                    <td>
                                        @foreach($videoTutorial->authorized_roles as $key => $authorized_roles)
                                            <span class="label label-info">{{ $authorized_roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.authorized_users') }}
                                    </th>
                                    <td>
                                        @foreach($videoTutorial->authorized_users as $key => $authorized_users)
                                            <span class="label label-info">{{ $authorized_users->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.video-tutorials.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection