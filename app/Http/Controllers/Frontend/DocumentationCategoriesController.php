<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDocumentationCategoryRequest;
use App\Http\Requests\StoreDocumentationCategoryRequest;
use App\Http\Requests\UpdateDocumentationCategoryRequest;
use App\Models\DocumentationCategory;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentationCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('documentation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategories = DocumentationCategory::with(['authorized_roles', 'authorized_users'])->get();

        return view('frontend.documentationCategories.index', compact('documentationCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('documentation_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('frontend.documentationCategories.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreDocumentationCategoryRequest $request)
    {
        $documentationCategory = DocumentationCategory::create($request->all());
        $documentationCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentationCategory->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('frontend.documentation-categories.index');
    }

    public function edit(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $documentationCategory->load('authorized_roles', 'authorized_users');

        return view('frontend.documentationCategories.edit', compact('authorized_roles', 'authorized_users', 'documentationCategory'));
    }

    public function update(UpdateDocumentationCategoryRequest $request, DocumentationCategory $documentationCategory)
    {
        $documentationCategory->update($request->all());
        $documentationCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentationCategory->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('frontend.documentation-categories.index');
    }

    public function show(DocumentationCategory $documentationCategory)
    {
        abort_if(Gate::denies('documentation_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentationCategory->load('authorized_roles', 'authorized_users', 'categoryDocumentations');

        return view('frontend.documentationCategories.show', compact('documentationCategory'));
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
