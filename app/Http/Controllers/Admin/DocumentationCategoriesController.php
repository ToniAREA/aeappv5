<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDocumentationCategoryRequest;
use App\Http\Requests\StoreDocumentationCategoryRequest;
use App\Http\Requests\UpdateDocumentationCategoryRequest;
use App\Models\DocumentationCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentationCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('documentation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategories = DocumentationCategory::all();

        return view('admin.documentationCategories.index', compact('documentationCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('documentation_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.documentationCategories.create');
    }

    public function store(StoreDocumentationCategoryRequest $request)
    {
        $documentationCategory = DocumentationCategory::create($request->all());

        return redirect()->route('admin.documentation-categories.index');
    }

    public function edit(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.documentationCategories.edit', compact('documentationCategory'));
    }

    public function update(UpdateDocumentationCategoryRequest $request, DocumentationCategory $documentationCategory)
    {
        $documentationCategory->update($request->all());

        return redirect()->route('admin.documentation-categories.index');
    }

    public function show(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategory->load('categoryDocumentations');

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
}
