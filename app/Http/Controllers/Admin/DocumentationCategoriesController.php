<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentationCategoryRequest;
use App\Http\Requests\StoreDocumentationCategoryRequest;
use App\Http\Requests\UpdateDocumentationCategoryRequest;
use App\Models\DocumentationCategory;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DocumentationCategoriesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('documentation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategories = DocumentationCategory::with(['authorized_roles', 'authorized_users', 'media'])->get();

        return view('admin.documentationCategories.index', compact('documentationCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('documentation_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.documentationCategories.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreDocumentationCategoryRequest $request)
    {
        $documentationCategory = DocumentationCategory::create($request->all());
        $documentationCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentationCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $documentationCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $documentationCategory->id]);
        }

        return redirect()->route('admin.documentation-categories.index');
    }

    public function edit(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $documentationCategory->load('authorized_roles', 'authorized_users');

        return view('admin.documentationCategories.edit', compact('authorized_roles', 'authorized_users', 'documentationCategory'));
    }

    public function update(UpdateDocumentationCategoryRequest $request, DocumentationCategory $documentationCategory)
    {
        $documentationCategory->update($request->all());
        $documentationCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentationCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $documentationCategory->photo || $request->input('photo') !== $documentationCategory->photo->file_name) {
                if ($documentationCategory->photo) {
                    $documentationCategory->photo->delete();
                }
                $documentationCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($documentationCategory->photo) {
            $documentationCategory->photo->delete();
        }

        return redirect()->route('admin.documentation-categories.index');
    }

    public function show(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategory->load('authorized_roles', 'authorized_users', 'categoryDocumentations');

        return view('admin.documentationCategories.show', compact('documentationCategory'));
    }

    public function destroy(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentationCategoryRequest $request)
    {
        $documentationCategories = DocumentationCategory::find(request('ids'));

        foreach ($documentationCategories as $documentationCategory) {
            $documentationCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('documentation_category_create') && Gate::denies('documentation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DocumentationCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
