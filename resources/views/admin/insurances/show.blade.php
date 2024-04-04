@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.insurance.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.id') }}
                        </th>
                        <td>
                            {{ $insurance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $insurance->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.provider_name') }}
                        </th>
                        <td>
                            {{ $insurance->provider_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.insurance_logo') }}
                        </th>
                        <td>
                            @if($insurance->insurance_logo)
                                <a href="{{ $insurance->insurance_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $insurance->insurance_logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.company') }}
                        </th>
                        <td>
                            {{ $insurance->company->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.policy_number') }}
                        </th>
                        <td>
                            {{ $insurance->policy_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.period') }}
                        </th>
                        <td>
                            {{ App\Models\Insurance::PERIOD_RADIO[$insurance->period] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.period_cost') }}
                        </th>
                        <td>
                            {{ $insurance->period_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.coverage_type') }}
                        </th>
                        <td>
                            {{ $insurance->coverage_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.start_date') }}
                        </th>
                        <td>
                            {{ $insurance->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.end_date') }}
                        </th>
                        <td>
                            {{ $insurance->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.files') }}
                        </th>
                        <td>
                            @foreach($insurance->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.notes') }}
                        </th>
                        <td>
                            {{ $insurance->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.internalnotes') }}
                        </th>
                        <td>
                            {{ $insurance->internalnotes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.link_a') }}
                        </th>
                        <td>
                            {{ $insurance->link_a }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.link_a_description') }}
                        </th>
                        <td>
                            {{ $insurance->link_a_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.link_b') }}
                        </th>
                        <td>
                            {{ $insurance->link_b }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.link_b_description') }}
                        </th>
                        <td>
                            {{ $insurance->link_b_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.insurance.fields.contacts') }}
                        </th>
                        <td>
                            @foreach($insurance->contacts as $key => $contacts)
                                <span class="label label-info">{{ $contacts->contact_first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.insurances.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection