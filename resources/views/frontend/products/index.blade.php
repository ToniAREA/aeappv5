@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('product_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.products.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Product',
                                    'route' => 'admin.products.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Product">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.product.fields.id') }}</th>
                                        <th>{{ trans('cruds.product.fields.is_online') }}</th>
                                        <th>{{ trans('cruds.product.fields.category') }}</th>
                                        <th>{{ trans('cruds.product.fields.brand') }}</th>
                                        <th>{{ trans('cruds.product.fields.ref_manu') }}</th>
                                        <th>{{ trans('cruds.product.fields.providers') }}</th>
                                        <th>{{ trans('cruds.product.fields.ref_provider') }}</th>
                                        <th>{{ trans('cruds.product.fields.model') }}</th>
                                        <th>{{ trans('cruds.product.fields.name') }}</th>
                                        <th>{{ trans('cruds.product.fields.photos') }}</th>
                                        <th>{{ trans('cruds.product.fields.product_price') }}</th>
                                        <th>{{ trans('cruds.product.fields.purchase_discount') }}</th>
                                        <th>{{ trans('cruds.product.fields.purchase_price') }}</th>
                                        <th>{{ trans('cruds.product.fields.has_stock') }}</th>
                                        <th>{{ trans('cruds.product.fields.stock') }}</th>
                                        <th>{{ trans('cruds.product.fields.local_stock') }}</th>
                                        <th>{{ trans('cruds.product.fields.product_location') }}</th>
                                        <th>{{ trans('cruds.assetLocation.fields.description') }}</th>
                                        <th>{{ trans('cruds.product.fields.tag') }}</th>
                                        <th>{{ trans('cruds.product.fields.link_a') }}</th>
                                        <th>{{ trans('cruds.product.fields.link_a_description') }}</th>
                                        <th>{{ trans('cruds.product.fields.link_b') }}</th>
                                        <th>{{ trans('cruds.product.fields.link_b_description') }}</th>
                                        <th>{{ trans('cruds.product.fields.seo_title') }}</th>
                                        <th>{{ trans('cruds.product.fields.seo_meta_description') }}</th>
                                        <th>{{ trans('cruds.product.fields.seo_slug') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr data-entry-id="{{ $product->id }}">
                                            <td style="text-align: center">{{ $product->id ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $product->is_online ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $product->is_online ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                @foreach($product->categories as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->brand->brand ?? '' }}</td>
                                            <td>{{ $product->ref_manu ?? '' }}</td>
                                            <td>
                                                @foreach($product->providers as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->ref_provider ?? '' }}</td>
                                            <td>{{ $product->model ?? '' }}</td>
                                            <td>{{ $product->name ?? '' }}</td>
                                            <td>
                                                @foreach($product->photos as $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->product_price ?? '' }}</td>
                                            <td>{{ $product->purchase_discount ?? '' }}</td>
                                            <td>{{ $product->purchase_price ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $product->has_stock ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $product->has_stock ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $product->stock ?? '' }}</td>
                                            <td>{{ $product->local_stock ?? '' }}</td>
                                            <td>{{ $product->product_location->name ?? '' }}</td>
                                            <td>{{ $product->product_location->description ?? '' }}</td>
                                            <td>
                                                @foreach($product->tags as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $product->link_a ?? '' }}</td>
                                            <td>{{ $product->link_a_description ?? '' }}</td>
                                            <td>{{ $product->link_b ?? '' }}</td>
                                            <td>{{ $product->link_b_description ?? '' }}</td>
                                            <td>{{ $product->seo_title ?? '' }}</td>
                                            <td>{{ $product->seo_meta_description ?? '' }}</td>
                                            <td>{{ $product->seo_slug ?? '' }}</td>
                                            <td>
                                                @can('product_show')
                                                    <a class="btn btn-xs btn-primary" href="{{ route('frontend.products.show', $product->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('product_edit')
                                                    <a class="btn btn-xs btn-info" href="{{ route('frontend.products.edit', $product->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('product_delete')
                                                    <form action="{{ route('frontend.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
           
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        })

    </script>
@endsection