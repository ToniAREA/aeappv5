@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.documentationCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentation-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $documentationCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.is_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $documentationCategory->is_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $documentationCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.photo') }}
                        </th>
                        <td>
                            @if($documentationCategory->photo)
                                <a href="{{ $documentationCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $documentationCategory->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $documentationCategory->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.authorized_roles') }}
                        </th>
                        <td>
                            @foreach($documentationCategory->authorized_roles as $key => $authorized_roles)
                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.documentationCategory.fields.authorized_users') }}
                        </th>
                        <td>
                            @foreach($documentationCategory->authorized_users as $key => $authorized_users)
                                <span class="label label-info">{{ $authorized_users->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documentation-categories.index') }}">
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
            <a class="nav-link" href="#category_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.documentation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="category_documentations">
            @includeIf('admin.documentationCategories.relationships.categoryDocumentations', ['documentations' => $documentationCategory->categoryDocumentations])
        </div>
    </div>
</div>

@endsection