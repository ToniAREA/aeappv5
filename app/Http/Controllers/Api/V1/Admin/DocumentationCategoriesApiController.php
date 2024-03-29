<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocumentationCategoryRequest;
use App\Http\Requests\UpdateDocumentationCategoryRequest;
use App\Http\Resources\Admin\DocumentationCategoryResource;
use App\Models\DocumentationCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentationCategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documentation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentationCategoryResource(DocumentationCategory::with(['authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreDocumentationCategoryRequest $request)
    {
        $documentationCategory = DocumentationCategory::create($request->all());
        $documentationCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentationCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $documentationCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new DocumentationCategoryResource($documentationCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentationCategoryResource($documentationCategory->load(['authorized_roles', 'authorized_users']));
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

        return (new DocumentationCategoryResource($documentationCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
