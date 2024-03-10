<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class DocumentationCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('documentation_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DocumentationCategory::with(['authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new DocumentationCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'documentation_category_show';
                $editGate      = 'documentation_category_edit';
                $deleteGate    = 'documentation_category_delete';
                $crudRoutePart = 'documentation-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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

            $table->rawColumns(['actions', 'placeholder', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        return view('admin.documentationCategories.index');
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
}
