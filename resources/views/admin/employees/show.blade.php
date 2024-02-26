@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.id') }}
                        </th>
                        <td>
                            {{ $employee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.id_employee') }}
                        </th>
                        <td>
                            {{ $employee->id_employee }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.namecomplete') }}
                        </th>
                        <td>
                            {{ $employee->namecomplete }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.user') }}
                        </th>
                        <td>
                            {{ $employee->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.contact') }}
                        </th>
                        <td>
                            {{ $employee->contact->contact_first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.photo') }}
                        </th>
                        <td>
                            @if($employee->photo)
                                <a href="{{ $employee->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $employee->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.status') }}
                        </th>
                        <td>
                            {{ $employee->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.contract_starts') }}
                        </th>
                        <td>
                            {{ $employee->contract_starts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.contract_ends') }}
                        </th>
                        <td>
                            {{ $employee->contract_ends }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.category') }}
                        </th>
                        <td>
                            {{ $employee->category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.notes') }}
                        </th>
                        <td>
                            {{ $employee->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.internalnotes') }}
                        </th>
                        <td>
                            {{ $employee->internalnotes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.link') }}
                        </th>
                        <td>
                            {{ $employee->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.link_description') }}
                        </th>
                        <td>
                            {{ $employee->link_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.employee.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $employee->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.employees.index') }}">
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
            <a class="nav-link" href="#employee_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#for_employee_to_dos" role="tab" data-toggle="tab">
                {{ trans('cruds.toDo.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_incomes" role="tab" data-toggle="tab">
                {{ trans('cruds.income.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_booking_slots" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingSlot.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_employee_attendances" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeAttendance.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_employee_holidays" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeHoliday.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_employee_skills" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeSkill.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#employee_employee_ratings" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeRating.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="employee_booking_lists">
            @includeIf('admin.employees.relationships.employeeBookingLists', ['bookingLists' => $employee->employeeBookingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="for_employee_to_dos">
            @includeIf('admin.employees.relationships.forEmployeeToDos', ['toDos' => $employee->forEmployeeToDos])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_expenses">
            @includeIf('admin.employees.relationships.employeeExpenses', ['expenses' => $employee->employeeExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_incomes">
            @includeIf('admin.employees.relationships.employeeIncomes', ['incomes' => $employee->employeeIncomes])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_booking_slots">
            @includeIf('admin.employees.relationships.employeeBookingSlots', ['bookingSlots' => $employee->employeeBookingSlots])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_employee_attendances">
            @includeIf('admin.employees.relationships.employeeEmployeeAttendances', ['employeeAttendances' => $employee->employeeEmployeeAttendances])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_employee_holidays">
            @includeIf('admin.employees.relationships.employeeEmployeeHolidays', ['employeeHolidays' => $employee->employeeEmployeeHolidays])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_employee_skills">
            @includeIf('admin.employees.relationships.employeeEmployeeSkills', ['employeeSkills' => $employee->employeeEmployeeSkills])
        </div>
        <div class="tab-pane" role="tabpanel" id="employee_employee_ratings">
            @includeIf('admin.employees.relationships.employeeEmployeeRatings', ['employeeRatings' => $employee->employeeEmployeeRatings])
        </div>
    </div>
</div>

@endsection