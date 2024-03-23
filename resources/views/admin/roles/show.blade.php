@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">
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
            <a class="nav-link" href="#for_role_to_dos" role="tab" data-toggle="tab">
                {{ trans('cruds.toDo.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#for_role_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#for_role_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_product_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.productCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_asset_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.assetCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.documentation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_content_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.contentCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_technical_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.technicalDocumentation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_documentation_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.documentationCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_content_pages" role="tab" data-toggle="tab">
                {{ trans('cruds.contentPage.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_tech_docs_types" role="tab" data-toggle="tab">
                {{ trans('cruds.techDocsType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_video_tutorials" role="tab" data-toggle="tab">
                {{ trans('cruds.videoTutorial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_faq_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.faqCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_faq_questions" role="tab" data-toggle="tab">
                {{ trans('cruds.faqQuestion.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_roles_video_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.videoCategory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="for_role_to_dos">
            @includeIf('admin.roles.relationships.forRoleToDos', ['toDos' => $role->forRoleToDos])
        </div>
        <div class="tab-pane" role="tabpanel" id="for_role_appointments">
            @includeIf('admin.roles.relationships.forRoleAppointments', ['appointments' => $role->forRoleAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="for_role_wlists">
            @includeIf('admin.roles.relationships.forRoleWlists', ['wlists' => $role->forRoleWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_product_categories">
            @includeIf('admin.roles.relationships.authorizedRolesProductCategories', ['productCategories' => $role->authorizedRolesProductCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_asset_categories">
            @includeIf('admin.roles.relationships.authorizedRolesAssetCategories', ['assetCategories' => $role->authorizedRolesAssetCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_documentations">
            @includeIf('admin.roles.relationships.authorizedRolesDocumentations', ['documentations' => $role->authorizedRolesDocumentations])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_content_categories">
            @includeIf('admin.roles.relationships.authorizedRolesContentCategories', ['contentCategories' => $role->authorizedRolesContentCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_technical_documentations">
            @includeIf('admin.roles.relationships.authorizedRolesTechnicalDocumentations', ['technicalDocumentations' => $role->authorizedRolesTechnicalDocumentations])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_documentation_categories">
            @includeIf('admin.roles.relationships.authorizedRolesDocumentationCategories', ['documentationCategories' => $role->authorizedRolesDocumentationCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_content_pages">
            @includeIf('admin.roles.relationships.authorizedRolesContentPages', ['contentPages' => $role->authorizedRolesContentPages])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_tech_docs_types">
            @includeIf('admin.roles.relationships.authorizedRolesTechDocsTypes', ['techDocsTypes' => $role->authorizedRolesTechDocsTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_video_tutorials">
            @includeIf('admin.roles.relationships.authorizedRolesVideoTutorials', ['videoTutorials' => $role->authorizedRolesVideoTutorials])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_faq_categories">
            @includeIf('admin.roles.relationships.authorizedRolesFaqCategories', ['faqCategories' => $role->authorizedRolesFaqCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_faq_questions">
            @includeIf('admin.roles.relationships.authorizedRolesFaqQuestions', ['faqQuestions' => $role->authorizedRolesFaqQuestions])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_roles_video_categories">
            @includeIf('admin.roles.relationships.authorizedRolesVideoCategories', ['videoCategories' => $role->authorizedRolesVideoCategories])
        </div>
    </div>
</div>

@endsection