@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.contentCategory.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.content-categories.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $contentCategory->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.is_online') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $contentCategory->is_online ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $contentCategory->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.slug') }}
                                        </th>
                                        <td>
                                            {{ $contentCategory->slug }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.photo') }}
                                        </th>
                                        <td>
                                            @if ($contentCategory->photo)
                                                <a href="{{ $contentCategory->photo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $contentCategory->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.authorized_roles') }}
                                        </th>
                                        <td>
                                            @foreach ($contentCategory->authorized_roles as $key => $authorized_roles)
                                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.contentCategory.fields.authorized_users') }}
                                        </th>
                                        <td>
                                            @foreach ($contentCategory->authorized_users as $key => $authorized_users)
                                                <span class="label label-info">{{ $authorized_users->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.content-categories.index') }}">
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
