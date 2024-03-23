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

class TechDocsTypesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tech_docs_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsTypes = TechDocsType::with(['authorized_roles', 'authorized_users'])->get();

        return view('admin.techDocsTypes.index', compact('techDocsTypes'));
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
