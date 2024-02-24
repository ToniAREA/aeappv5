<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTechDocsTypeRequest;
use App\Http\Requests\StoreTechDocsTypeRequest;
use App\Http\Requests\UpdateTechDocsTypeRequest;
use App\Models\TechDocsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechDocsTypesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tech_docs_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsTypes = TechDocsType::all();

        return view('admin.techDocsTypes.index', compact('techDocsTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('tech_docs_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.techDocsTypes.create');
    }

    public function store(StoreTechDocsTypeRequest $request)
    {
        $techDocsType = TechDocsType::create($request->all());

        return redirect()->route('admin.tech-docs-types.index');
    }

    public function edit(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.techDocsTypes.edit', compact('techDocsType'));
    }

    public function update(UpdateTechDocsTypeRequest $request, TechDocsType $techDocsType)
    {
        $techDocsType->update($request->all());

        return redirect()->route('admin.tech-docs-types.index');
    }

    public function show(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->load('docTypeTechnicalDocumentations');

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
