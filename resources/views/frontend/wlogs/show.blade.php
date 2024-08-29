@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.wlog.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.wlogs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $wlog->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.wlist') }}
                                    </th>
                                    <td>
                                        {{ $wlog->wlist->description ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.boat_namecomplete') }}
                                    </th>
                                    <td>
                                        {{ $wlog->boat_namecomplete }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $wlog->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $wlog->employee->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.marina') }}
                                    </th>
                                    <td>
                                        {{ $wlog->marina->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $wlog->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.hours') }}
                                    </th>
                                    <td>
                                        {{ $wlog->hours }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.hourly_rate') }}
                                    </th>
                                    <td>
                                        {{ $wlog->hourly_rate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.travel_cost_included') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $wlog->travel_cost_included ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.total_travel_cost') }}
                                    </th>
                                    <td>
                                        {{ $wlog->total_travel_cost }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.total_access_cost') }}
                                    </th>
                                    <td>
                                        {{ $wlog->total_access_cost }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.wlist_finished') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $wlog->wlist_finished ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.invoiced_line') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $wlog->invoiced_line ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $wlog->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.internal_notes') }}
                                    </th>
                                    <td>
                                        {{ $wlog->internal_notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.photos') }}
                                    </th>
                                    <td>
                                        @foreach($wlog->photos as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.wlog.fields.financial_document') }}
                                    </th>
                                    <td>
                                        {{ $wlog->financial_document->reference_number ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.wlogs.index') }}">
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