@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.assetLocation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.asset-locations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.is_available') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $assetLocation->is_available ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $assetLocation->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.assetLocation.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($assetLocation->photo)
                                            <a href="{{ $assetLocation->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $assetLocation->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.asset-locations.index') }}">
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