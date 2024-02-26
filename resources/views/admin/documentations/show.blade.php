@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.documentation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentations.index') }}">
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
                            <input type="checkbox" disabled="disabled" {{ $documentation->is_valid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentation.fields.file') }}
                        </th>
                        <td>
                            @if($documentation->file)
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
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection