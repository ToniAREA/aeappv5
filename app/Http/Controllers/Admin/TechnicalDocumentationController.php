<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTechnicalDocumentationRequest;
use App\Http\Requests\StoreTechnicalDocumentationRequest;
use App\Http\Requests\UpdateTechnicalDocumentationRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Role;
use App\Models\TechDocsType;
use App\Models\TechnicalDocumentation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TechnicalDocumentationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('technical_documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TechnicalDocumentation::with(['doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new TechnicalDocumentation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'technical_documentation_show';
                $editGate      = 'technical_documentation_edit';
                $deleteGate    = 'technical_documentation_delete';
                $crudRoutePart = 'technical-documentations';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('doc_type_name', function ($row) {
                return $row->doc_type ? $row->doc_type->name : '';
            });

            $table->addColumn('brand_brand', function ($row) {
                return $row->brand ? $row->brand->brand : '';
            });

            $table->addColumn('product_model', function ($row) {
                return $row->product ? $row->product->model : '';
            });

            $table->editColumn('product.name', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->name) : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
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
            $table->editColumn('authorized_roles', function ($row) {
                $labels = [];
                foreach ($row->authorized_roles as $authorized_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('authorized_users', function ($row) {
                $labels = [];
                foreach ($row->authorized_users as $authorized_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_user->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'show_online', 'file', 'doc_type', 'brand', 'product', 'image', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        return view('admin.technicalDocumentations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('technical_documentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doc_types = TechDocsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.technicalDocumentations.create', compact('authorized_roles', 'authorized_users', 'brands', 'doc_types', 'products'));
    }

    public function store(StoreTechnicalDocumentationRequest $request)
    {
        $technicalDocumentation = TechnicalDocumentation::create($request->all());
        $technicalDocumentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $technicalDocumentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($request->input('image', false)) {
            $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $technicalDocumentation->id]);
        }

        return redirect()->route('admin.technical-documentations.index');
    }

    public function edit(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doc_types = TechDocsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $technicalDocumentation->load('doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users');

        return view('admin.technicalDocumentations.edit', compact('authorized_roles', 'authorized_users', 'brands', 'doc_types', 'products', 'technicalDocumentation'));
    }

    public function update(UpdateTechnicalDocumentationRequest $request, TechnicalDocumentation $technicalDocumentation)
    {
        $technicalDocumentation->update($request->all());
        $technicalDocumentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $technicalDocumentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            if (! $technicalDocumentation->file || $request->input('file') !== $technicalDocumentation->file->file_name) {
                if ($technicalDocumentation->file) {
                    $technicalDocumentation->file->delete();
                }
                $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($technicalDocumentation->file) {
            $technicalDocumentation->file->delete();
        }

        if ($request->input('image', false)) {
            if (! $technicalDocumentation->image || $request->input('image') !== $technicalDocumentation->image->file_name) {
                if ($technicalDocumentation->image) {
                    $technicalDocumentation->image->delete();
                }
                $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($technicalDocumentation->image) {
            $technicalDocumentation->image->delete();
        }

        return redirect()->route('admin.technical-documentations.index');
    }

    public function show(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicalDocumentation->load('doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users');

        return view('admin.technicalDocumentations.show', compact('technicalDocumentation'));
    }

    public function destroy(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicalDocumentation->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechnicalDocumentationRequest $request)
    {
        $technicalDocumentations = TechnicalDocumentation::find(request('ids'));

        foreach ($technicalDocumentations as $technicalDocumentation) {
            $technicalDocumentation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('technical_documentation_create') && Gate::denies('technical_documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TechnicalDocumentation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
