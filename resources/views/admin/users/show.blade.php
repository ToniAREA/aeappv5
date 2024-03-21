@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.two_factor') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#user_employees" role="tab" data-toggle="tab">
                {{ trans('cruds.employee.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_user_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_user_comments" role="tab" data-toggle="tab">
                {{ trans('cruds.comment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#actual_holder_assets" role="tab" data-toggle="tab">
                {{ trans('cruds.asset.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_assets_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsRental.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_user_employee_ratings" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeRating.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_settings" role="tab" data-toggle="tab">
                {{ trans('cruds.userSetting.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_waiting_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.waitingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_product_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.productCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_asset_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.assetCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_content_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.contentCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_technical_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.technicalDocumentation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_documentation_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.documentationCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_content_pages" role="tab" data-toggle="tab">
                {{ trans('cruds.contentPage.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_tech_docs_types" role="tab" data-toggle="tab">
                {{ trans('cruds.techDocsType.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_video_tutorials" role="tab" data-toggle="tab">
                {{ trans('cruds.videoTutorial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_faq_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.faqCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_faq_questions" role="tab" data-toggle="tab">
                {{ trans('cruds.faqQuestion.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authorized_users_video_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.videoCategory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_employees">
            @includeIf('admin.users.relationships.userEmployees', ['employees' => $user->userEmployees])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_wlogs">
            @includeIf('admin.users.relationships.employeeWlogs', ['wlogs' => $user->employeeWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_user_wlists">
            @includeIf('admin.users.relationships.fromUserWlists', ['wlists' => $user->fromUserWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_user_comments">
            @includeIf('admin.users.relationships.fromUserComments', ['comments' => $user->fromUserComments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_booking_lists">
            @includeIf('admin.users.relationships.userBookingLists', ['bookingLists' => $user->userBookingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="actual_holder_assets">
            @includeIf('admin.users.relationships.actualHolderAssets', ['assets' => $user->actualHolderAssets])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_mlogs">
            @includeIf('admin.users.relationships.employeeMlogs', ['mlogs' => $user->employeeMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_assets_rentals">
            @includeIf('admin.users.relationships.userAssetsRentals', ['assetsRentals' => $user->userAssetsRentals])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_suscriptions">
            @includeIf('admin.users.relationships.userSuscriptions', ['suscriptions' => $user->userSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_maintenance_suscriptions">
            @includeIf('admin.users.relationships.userMaintenanceSuscriptions', ['maintenanceSuscriptions' => $user->userMaintenanceSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_user_employee_ratings">
            @includeIf('admin.users.relationships.fromUserEmployeeRatings', ['employeeRatings' => $user->fromUserEmployeeRatings])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_iot_suscriptions">
            @includeIf('admin.users.relationships.userIotSuscriptions', ['iotSuscriptions' => $user->userIotSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_settings">
            @includeIf('admin.users.relationships.userUserSettings', ['userSettings' => $user->userUserSettings])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_waiting_lists">
            @includeIf('admin.users.relationships.userWaitingLists', ['waitingLists' => $user->userWaitingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_product_categories">
            @includeIf('admin.users.relationships.authorizedUsersProductCategories', ['productCategories' => $user->authorizedUsersProductCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_asset_categories">
            @includeIf('admin.users.relationships.authorizedUsersAssetCategories', ['assetCategories' => $user->authorizedUsersAssetCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_content_categories">
            @includeIf('admin.users.relationships.authorizedUsersContentCategories', ['contentCategories' => $user->authorizedUsersContentCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_technical_documentations">
            @includeIf('admin.users.relationships.authorizedUsersTechnicalDocumentations', ['technicalDocumentations' => $user->authorizedUsersTechnicalDocumentations])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_documentation_categories">
            @includeIf('admin.users.relationships.authorizedUsersDocumentationCategories', ['documentationCategories' => $user->authorizedUsersDocumentationCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_content_pages">
            @includeIf('admin.users.relationships.authorizedUsersContentPages', ['contentPages' => $user->authorizedUsersContentPages])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_tech_docs_types">
            @includeIf('admin.users.relationships.authorizedUsersTechDocsTypes', ['techDocsTypes' => $user->authorizedUsersTechDocsTypes])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_video_tutorials">
            @includeIf('admin.users.relationships.authorizedUsersVideoTutorials', ['videoTutorials' => $user->authorizedUsersVideoTutorials])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_faq_categories">
            @includeIf('admin.users.relationships.authorizedUsersFaqCategories', ['faqCategories' => $user->authorizedUsersFaqCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_faq_questions">
            @includeIf('admin.users.relationships.authorizedUsersFaqQuestions', ['faqQuestions' => $user->authorizedUsersFaqQuestions])
        </div>
        <div class="tab-pane" role="tabpanel" id="authorized_users_video_categories">
            @includeIf('admin.users.relationships.authorizedUsersVideoCategories', ['videoCategories' => $user->authorizedUsersVideoCategories])
        </div>
    </div>
</div>

@endsection