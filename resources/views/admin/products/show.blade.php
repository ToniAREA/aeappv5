@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.is_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->is_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <td>
                            @foreach($product->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.brand') }}
                        </th>
                        <td>
                            {{ $product->brand->brand ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.ref_manu') }}
                        </th>
                        <td>
                            {{ $product->ref_manu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.providers') }}
                        </th>
                        <td>
                            @foreach($product->providers as $key => $providers)
                                <span class="label label-info">{{ $providers->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.ref_provider') }}
                        </th>
                        <td>
                            {{ $product->ref_provider }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.model') }}
                        </th>
                        <td>
                            {{ $product->model }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.short_desc') }}
                        </th>
                        <td>
                            {!! $product->short_desc !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <td>
                            {!! $product->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.photos') }}
                        </th>
                        <td>
                            @foreach($product->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.product_price') }}
                        </th>
                        <td>
                            {{ $product->product_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.purchase_discount') }}
                        </th>
                        <td>
                            {{ $product->purchase_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.purchase_price') }}
                        </th>
                        <td>
                            {{ $product->purchase_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.has_stock') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->has_stock ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.stock') }}
                        </th>
                        <td>
                            {{ $product->stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.local_stock') }}
                        </th>
                        <td>
                            {{ $product->local_stock }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.product_location') }}
                        </th>
                        <td>
                            {{ $product->product_location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tag') }}
                        </th>
                        <td>
                            @foreach($product->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.link_a') }}
                        </th>
                        <td>
                            {{ $product->link_a }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.link_a_description') }}
                        </th>
                        <td>
                            {{ $product->link_a_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.link_b') }}
                        </th>
                        <td>
                            {{ $product->link_b }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.link_b_description') }}
                        </th>
                        <td>
                            {{ $product->link_b_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.seo_title') }}
                        </th>
                        <td>
                            {{ $product->seo_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.seo_meta_description') }}
                        </th>
                        <td>
                            {{ $product->seo_meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.seo_slug') }}
                        </th>
                        <td>
                            {{ $product->seo_slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
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
            <a class="nav-link" href="#product_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_technical_documentations" role="tab" data-toggle="tab">
                {{ trans('cruds.technicalDocumentation.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_iot_devices" role="tab" data-toggle="tab">
                {{ trans('cruds.iotDevice.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product_financial_document_items" role="tab" data-toggle="tab">
                {{ trans('cruds.financialDocumentItem.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="product_mlogs">
            @includeIf('admin.products.relationships.productMlogs', ['mlogs' => $product->productMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_technical_documentations">
            @includeIf('admin.products.relationships.productTechnicalDocumentations', ['technicalDocumentations' => $product->productTechnicalDocumentations])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_iot_devices">
            @includeIf('admin.products.relationships.productIotDevices', ['iotDevices' => $product->productIotDevices])
        </div>
        <div class="tab-pane" role="tabpanel" id="product_financial_document_items">
            @includeIf('admin.products.relationships.productFinancialDocumentItems', ['financialDocumentItems' => $product->productFinancialDocumentItems])
        </div>
    </div>
</div>

@endsection