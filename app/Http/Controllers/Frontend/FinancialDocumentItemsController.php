<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFinancialDocumentItemRequest;
use App\Http\Requests\StoreFinancialDocumentItemRequest;
use App\Http\Requests\UpdateFinancialDocumentItemRequest;
use App\Models\FinalcialDocument;
use App\Models\FinancialDocumentItem;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinancialDocumentItemsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('financial_document_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialDocumentItems = FinancialDocumentItem::with(['financial_document', 'product'])->get();

        return view('frontend.financialDocumentItems.index', compact('financialDocumentItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('financial_document_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.financialDocumentItems.create', compact('financial_documents', 'products'));
    }

    public function store(StoreFinancialDocumentItemRequest $request)
    {
        $financialDocumentItem = FinancialDocumentItem::create($request->all());

        return redirect()->route('frontend.financial-document-items.index');
    }

    public function edit(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financialDocumentItem->load('financial_document', 'product');

        return view('frontend.financialDocumentItems.edit', compact('financialDocumentItem', 'financial_documents', 'products'));
    }

    public function update(UpdateFinancialDocumentItemRequest $request, FinancialDocumentItem $financialDocumentItem)
    {
        $financialDocumentItem->update($request->all());

        return redirect()->route('frontend.financial-document-items.index');
    }

    public function show(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialDocumentItem->load('financial_document', 'product');

        return view('frontend.financialDocumentItems.show', compact('financialDocumentItem'));
    }

    public function destroy(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialDocumentItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinancialDocumentItemRequest $request)
    {
        $financialDocumentItems = FinancialDocumentItem::find(request('ids'));

        foreach ($financialDocumentItems as $financialDocumentItem) {
            $financialDocumentItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
