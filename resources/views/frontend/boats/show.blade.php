@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.boat.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $boat->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.ref') }}
                                    </th>
                                    <td>
                                        {{ $boat->ref }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.boat_type') }}
                                    </th>
                                    <td>
                                        {{ $boat->boat_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $boat->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.boat_photo') }}
                                    </th>
                                    <td>
                                        @if($boat->boat_photo)
                                            <a href="{{ $boat->boat_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $boat->boat_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.imo') }}
                                    </th>
                                    <td>
                                        {{ $boat->imo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.mmsi') }}
                                    </th>
                                    <td>
                                        {{ $boat->mmsi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.marina') }}
                                    </th>
                                    <td>
                                        {{ $boat->marina->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.sat_phone') }}
                                    </th>
                                    <td>
                                        {{ $boat->sat_phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $boat->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.internal_notes') }}
                                    </th>
                                    <td>
                                        {{ $boat->internal_notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.clients') }}
                                    </th>
                                    <td>
                                        @foreach($boat->clients as $key => $clients)
                                            <span class="label label-info">{{ $clients->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $boat->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $boat->link_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.last_use') }}
                                    </th>
                                    <td>
                                        {{ $boat->last_use }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.settings_data') }}
                                    </th>
                                    <td>
                                        {{ $boat->settings_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.public_ip') }}
                                    </th>
                                    <td>
                                        {{ $boat->public_ip }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boat.fields.coordinates') }}
                                    </th>
                                    <td>
                                        {{ $boat->coordinates }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
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