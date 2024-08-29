<?php

namespace App\Http\Controllers\Frontend;

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

class TechnicalDocumentationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('technical_documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicalDocumentations = TechnicalDocumentation::with(['doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users', 'media'])->get();

        return view('frontend.technicalDocumentations.index', compact('technicalDocumentations'));
    }

    public function create()
    {
        abort_if(Gate::denies('technical_documentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doc_types = TechDocsType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('frontend.technicalDocumentations.create', compact('authorized_roles', 'authorized_users', 'brands', 'doc_types', 'products'));
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

        return redirect()->route('frontend.technical-documentations.index');
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

        return view('frontend.technicalDocumentations.edit', compact('authorized_roles', 'authorized_users', 'brands', 'doc_types', 'products', 'technicalDocumentation'));
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

        return redirect()->route('frontend.technical-documentations.index');
    }

    public function show(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicalDocumentation->load('doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users');

        return view('frontend.technicalDocumentations.show', compact('technicalDocumentation'));
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
