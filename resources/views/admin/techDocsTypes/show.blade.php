@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.techDocsType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tech-docs-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.techDocsType.fields.id') }}
                        </th>
                        <td>
                            {{ $techDocsType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.techDocsType.fields.name') }}
                        </th>
                        <td>
                            {{ $techDocsType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.techDocsType.fields.description') }}
                        </th>
                        <td>
                            {{ $techDocsType->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.techDocsType.fields.authorized_roles') }}
                        </th>
                        <td>
                            @foreach($techDocsType->authorized_roles as $key => $authorized_roles)
                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.techDocsType.fields.authorized_users') }}
                        </th>
                        <td>
                            @foreach($techDocsType->authorized_users as $key => $authorized_users)
                                <span class="label label-info">{{ $authorized_users->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tech-docs-types.index') }}">
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
            <a class="nav-link" href="#doc_type_technical_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.technicalDocumentation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="doc_type_technical_documentations">
            @includeIf('admin.techDocsTypes.relationships.docTypeTechnicalDocumentations', ['technicalDocumentations' => $techDocsType->docTypeTechnicalDocumentations])
        </div>
    </div>
</div>

@endsection