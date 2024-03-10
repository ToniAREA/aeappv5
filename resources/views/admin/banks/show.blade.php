@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bank.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.id') }}
                        </th>
                        <td>
                            {{ $bank->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.name') }}
                        </th>
                        <td>
                            {{ $bank->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bank->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.branch') }}
                        </th>
                        <td>
                            {{ $bank->branch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.account_number') }}
                        </th>
                        <td>
                            {{ $bank->account_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.account_name') }}
                        </th>
                        <td>
                            {{ $bank->account_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.swift_code') }}
                        </th>
                        <td>
                            {{ $bank->swift_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.address') }}
                        </th>
                        <td>
                            {{ $bank->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.join_date') }}
                        </th>
                        <td>
                            {{ $bank->join_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.current_balance') }}
                        </th>
                        <td>
                            {{ $bank->current_balance }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.notes') }}
                        </th>
                        <td>
                            {{ $bank->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $bank->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.link_a') }}
                        </th>
                        <td>
                            {{ $bank->link_a }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.link_a_description') }}
                        </th>
                        <td>
                            {{ $bank->link_a_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.link_b') }}
                        </th>
                        <td>
                            {{ $bank->link_b }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.link_b_description') }}
                        </th>
                        <td>
                            {{ $bank->link_b_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bank.fields.files') }}
                        </th>
                        <td>
                            @foreach($bank->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection