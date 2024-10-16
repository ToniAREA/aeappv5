@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.assetCategory.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.asset-categories.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $assetCategory->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.is_online') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $assetCategory->is_online ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $assetCategory->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.description') }}
                                        </th>
                                        <td>
                                            {{ $assetCategory->description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.authorized_roles') }}
                                        </th>
                                        <td>
                                            @foreach ($assetCategory->authorized_roles as $key => $authorized_roles)
                                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.authorized_users') }}
                                        </th>
                                        <td>
                                            @foreach ($assetCategory->authorized_users as $key => $authorized_users)
                                                <span class="label label-info">{{ $authorized_users->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.assetCategory.fields.photo') }}
                                        </th>
                                        <td>
                                            @if ($assetCategory->photo)
                                                <a href="{{ $assetCategory->photo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $assetCategory->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.asset-categories.index') }}">
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
