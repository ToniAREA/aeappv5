<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechDocsTypeRequest;
use App\Http\Requests\UpdateTechDocsTypeRequest;
use App\Http\Resources\Admin\TechDocsTypeResource;
use App\Models\TechDocsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechDocsTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tech_docs_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechDocsTypeResource(TechDocsType::with(['authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreTechDocsTypeRequest $request)
    {
        $techDocsType = TechDocsType::create($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));

        return (new TechDocsTypeResource($techDocsType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechDocsTypeResource($techDocsType->load(['authorized_roles', 'authorized_users']));
    }

    public function update(UpdateTechDocsTypeRequest $request, TechDocsType $techDocsType)
    {
        $techDocsType->update($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));

        return (new TechDocsTypeResource($techDocsType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
