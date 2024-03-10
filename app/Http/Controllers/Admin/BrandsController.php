<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Provider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BrandsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Brand::with(['providers'])->select(sprintf('%s.*', (new Brand)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'brand_show';
                $editGate      = 'brand_edit';
                $deleteGate    = 'brand_delete';
                $crudRoutePart = 'brands';

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
            $table->editColumn('brand', function ($row) {
                return $row->brand ? $row->brand : '';
            });
            $table->editColumn('brand_logo', function ($row) {
                if ($photo = $row->brand_logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('brand_url', function ($row) {
                return $row->brand_url ? $row->brand_url : '';
            });
            $table->editColumn('providers', function ($row) {
                $labels = [];
                foreach ($row->providers as $provider) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $provider->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand_logo', 'providers']);

            return $table->make(true);
        }

        $providers = Provider::get();

        return view('admin.brands.index', compact('providers'));
    }

    public function create()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        return view('admin.brands.create', compact('providers'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        $brand->providers()->sync($request->input('providers', []));
        if ($request->input('brand_logo', false)) {
            $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))->toMediaCollection('brand_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $brand->id]);
        }

        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        abort_if(Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $providers = Provider::pluck('name', 'id');

        $brand->load('providers');

        return view('admin.brands.edit', compact('brand', 'providers'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        $brand->providers()->sync($request->input('providers', []));
        if ($request->input('brand_logo', false)) {
            if (! $brand->brand_logo || $request->input('brand_logo') !== $brand->brand_logo->file_name) {
                if ($brand->brand_logo) {
                    $brand->brand_logo->delete();
                }
                $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))->toMediaCollection('brand_logo');
            }
        } elseif ($brand->brand_logo) {
            $brand->brand_logo->delete();
        }

        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->load('providers', 'brandProducts', 'brandTechnicalDocumentations', 'brandsProviders');

        return view('admin.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->delete();

        return back();
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        $brands = Brand::find(request('ids'));

        foreach ($brands as $brand) {
            $brand->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('brand_create') && Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Brand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
