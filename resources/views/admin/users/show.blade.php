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
            <a class="nav-link" href="#for_user_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
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
        <div class="tab-pane" role="tabpanel" id="for_user_appointments">
            @includeIf('admin.users.relationships.forUserAppointments', ['appointments' => $user->forUserAppointments])
        </div>
    </div>
</div>

@endsection