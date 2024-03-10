<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTechDocsTypeRequest;
use App\Http\Requests\StoreTechDocsTypeRequest;
use App\Http\Requests\UpdateTechDocsTypeRequest;
use App\Models\Role;
use App\Models\TechDocsType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TechDocsTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tech_docs_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TechDocsType::with(['authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new TechDocsType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tech_docs_type_show';
                $editGate      = 'tech_docs_type_edit';
                $deleteGate    = 'tech_docs_type_delete';
                $crudRoutePart = 'tech-docs-types';

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

        return view('admin.techDocsTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tech_docs_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.techDocsTypes.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreTechDocsTypeRequest $request)
    {
        $techDocsType = TechDocsType::create($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('admin.tech-docs-types.index');
    }

    public function edit(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $techDocsType->load('authorized_roles', 'authorized_users');

        return view('admin.techDocsTypes.edit', compact('authorized_roles', 'authorized_users', 'techDocsType'));
    }

    public function update(UpdateTechDocsTypeRequest $request, TechDocsType $techDocsType)
    {
        $techDocsType->update($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('admin.tech-docs-types.index');
    }

    public function show(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->load('authorized_roles', 'authorized_users', 'docTypeTechnicalDocumentations');

        return view('admin.techDocsTypes.show', compact('techDocsType'));
    }

    public function destroy(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechDocsTypeRequest $request)
    {
        $techDocsTypes = TechDocsType::find(request('ids'));

        foreach ($techDocsTypes as $techDocsType) {
            $techDocsType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
