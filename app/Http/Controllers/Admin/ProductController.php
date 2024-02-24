<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\AssetLocation;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['categories', 'brand', 'providers', 'product_location', 'tags'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('brand_brand', function ($row) {
                return $row->brand ? $row->brand->brand : '';
            });

            $table->editColumn('ref_manu', function ($row) {
                return $row->ref_manu ? $row->ref_manu : '';
            });
            $table->editColumn('providers', function ($row) {
                $labels = [];
                foreach ($row->providers as $provider) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $provider->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('ref_provider', function ($row) {
                return $row->ref_provider ? $row->ref_provider : '';
            });
            $table->editColumn('model', function ($row) {
                return $row->model ? $row->model : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('photos', function ($row) {
                if (! $row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('product_price', function ($row) {
                return $row->product_price ? $row->product_price : '';
            });
            $table->editColumn('purchase_discount', function ($row) {
                return $row->purchase_discount ? $row->purchase_discount : '';
            });
            $table->editColumn('purchase_price', function ($row) {
                return $row->purchase_price ? $row->purchase_price : '';
            });
            $table->editColumn('has_stock', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->has_stock ? 'checked' : null) . '>';
            });
            $table->editColumn('local_stock', function ($row) {
                return $row->local_stock ? $row->local_stock : '';
            });
            $table->addColumn('product_location_name', function ($row) {
                return $row->product_location ? $row->product_location->name : '';
            });

            $table->editColumn('product_location.description', function ($row) {
                return $row->product_location ? (is_string($row->product_location) ? $row->product_location : $row->product_location->description) : '';
            });
            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('link_a', function ($row) {
                return $row->link_a ? $row->link_a : '';
            });
            $table->editColumn('link_a_description', function ($row) {
                return $row->link_a_description ? $row->link_a_description : '';
            });
            $table->editColumn('link_b', function ($row) {
                return $row->link_b ? $row->link_b : '';
            });
            $table->editColumn('link_b_description', function ($row) {
                return $row->link_b_description ? $row->link_b_description : '';
            });
            $table->editColumn('seo_title', function ($row) {
                return $row->seo_title ? $row->seo_title : '';
            });
            $table->editColumn('seo_meta_description', function ($row) {
                return $row->seo_meta_description ? $row->seo_meta_description : '';
            });
            $table->editColumn('seo_slug', function ($row) {
                return $row->seo_slug ? $row->seo_slug : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'brand', 'providers', 'show_online', 'photos', 'has_stock', 'product_location', 'tag']);

            return $table->make(true);
        }

        $product_categories = ProductCategory::get();
        $brands             = Brand::get();
        $providers          = Provider::get();
        $asset_locations    = AssetLocation::get();
        $product_tags       = ProductTag::get();

        return view('admin.products.index', compact('product_categories', 'brands', 'providers', 'asset_locations', 'product_tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $brands = Brand::pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::pluck('name', 'id');

        $product_locations = AssetLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ProductTag::pluck('name', 'id');

        return view('admin.products.create', compact('brands', 'categories', 'product_locations', 'providers', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->providers()->sync($request->input('providers', []));
        $product->tags()->sync($request->input('tags', []));
        foreach ($request->input('photos', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $brands = Brand::pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::pluck('name', 'id');

        $product_locations = AssetLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = ProductTag::pluck('name', 'id');

        $product->load('categories', 'brand', 'providers', 'product_location', 'tags');

        return view('admin.products.edit', compact('brands', 'categories', 'product', 'product_locations', 'providers', 'tags'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->providers()->sync($request->input('providers', []));
        $product->tags()->sync($request->input('tags', []));
        if (count($product->photos) > 0) {
            foreach ($product->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('categories', 'brand', 'providers', 'product_location', 'tags', 'productMlogs', 'productTechnicalDocumentations');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            $product->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
