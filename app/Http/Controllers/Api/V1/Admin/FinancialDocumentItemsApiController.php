<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancialDocumentItemRequest;
use App\Http\Requests\UpdateFinancialDocumentItemRequest;
use App\Http\Resources\Admin\FinancialDocumentItemResource;
use App\Models\FinancialDocumentItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancialDocumentItemsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('financial_document_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinancialDocumentItemResource(FinancialDocumentItem::with(['financial_document', 'product'])->get());
    }

    public function store(StoreFinancialDocumentItemRequest $request)
    {
        $financialDocumentItem = FinancialDocumentItem::create($request->all());

        return (new FinancialDocumentItemResource($financialDocumentItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinancialDocumentItemResource($financialDocumentItem->load(['financial_document', 'product']));
    }

    public function update(UpdateFinancialDocumentItemRequest $request, FinancialDocumentItem $financialDocumentItem)
    {
        $financialDocumentItem->update($request->all());

        return (new FinancialDocumentItemResource($financialDocumentItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialDocumentItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
