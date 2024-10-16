@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.documentation.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.documentations.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $documentation->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $documentation->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.category') }}
                                        </th>
                                        <td>
                                            {{ $documentation->category->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.expiration_date') }}
                                        </th>
                                        <td>
                                            {{ $documentation->expiration_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.is_valid') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $documentation->is_valid ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.file') }}
                                        </th>
                                        <td>
                                            @if ($documentation->file)
                                                <a href="{{ $documentation->file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.notes') }}
                                        </th>
                                        <td>
                                            {{ $documentation->notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.internal_notes') }}
                                        </th>
                                        <td>
                                            {{ $documentation->internal_notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.link') }}
                                        </th>
                                        <td>
                                            {{ $documentation->link }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.link_description') }}
                                        </th>
                                        <td>
                                            {{ $documentation->link_description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.authorized_roles') }}
                                        </th>
                                        <td>
                                            @foreach ($documentation->authorized_roles as $key => $authorized_roles)
                                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.documentation.fields.authorized_users') }}
                                        </th>
                                        <td>
                                            @foreach ($documentation->authorized_users as $key => $authorized_users)
                                                <span class="label label-info">{{ $authorized_users->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.documentations.index') }}">
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
