<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinantialDocumentTaxRequest;
use App\Http\Requests\UpdateFinantialDocumentTaxRequest;
use App\Http\Resources\Admin\FinantialDocumentTaxResource;
use App\Models\FinantialDocumentTax;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinantialDocumentTaxesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finantial_document_tax_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinantialDocumentTaxResource(FinantialDocumentTax::with(['item'])->get());
    }

    public function store(StoreFinantialDocumentTaxRequest $request)
    {
        $finantialDocumentTax = FinantialDocumentTax::create($request->all());

        return (new FinantialDocumentTaxResource($finantialDocumentTax))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinantialDocumentTaxResource($finantialDocumentTax->load(['item']));
    }

    public function update(UpdateFinantialDocumentTaxRequest $request, FinantialDocumentTax $finantialDocumentTax)
    {
        $finantialDocumentTax->update($request->all());

        return (new FinantialDocumentTaxResource($finantialDocumentTax))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentTax->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
