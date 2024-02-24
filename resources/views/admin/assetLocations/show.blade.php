@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assetLocation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.asset-locations.index') }}">
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
                    <tr>
                        <th>
                            {{ trans('cruds.assetLocation.fields.available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assetLocation->available ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.asset-locations.index') }}">
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
            <a class="nav-link" href="#location_assets" role="tab" data-toggle="tab">
                {{ trans('cruds.asset.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_location_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="location_assets">
            @includeIf('admin.assetLocations.relationships.locationAssets', ['assets' => $assetLocation->locationAssets])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_location_products">
            @includeIf('admin.assetLocations.relationships.productLocationProducts', ['products' => $assetLocation->productLocationProducts])
        </div>
    </div>
</div>

@endsection