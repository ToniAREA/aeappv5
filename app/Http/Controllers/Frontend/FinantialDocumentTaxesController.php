<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFinantialDocumentTaxRequest;
use App\Http\Requests\StoreFinantialDocumentTaxRequest;
use App\Http\Requests\UpdateFinantialDocumentTaxRequest;
use App\Models\FinancialDocumentItem;
use App\Models\FinantialDocumentTax;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinantialDocumentTaxesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('finantial_document_tax_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentTaxes = FinantialDocumentTax::with(['item'])->get();

        return view('frontend.finantialDocumentTaxes.index', compact('finantialDocumentTaxes'));
    }

    public function create()
    {
        abort_if(Gate::denies('finantial_document_tax_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.finantialDocumentTaxes.create', compact('items'));
    }

    public function store(StoreFinantialDocumentTaxRequest $request)
    {
        $finantialDocumentTax = FinantialDocumentTax::create($request->all());

        return redirect()->route('frontend.finantial-document-taxes.index');
    }

    public function edit(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finantialDocumentTax->load('item');

        return view('frontend.finantialDocumentTaxes.edit', compact('finantialDocumentTax', 'items'));
    }

    public function update(UpdateFinantialDocumentTaxRequest $request, FinantialDocumentTax $finantialDocumentTax)
    {
        $finantialDocumentTax->update($request->all());

        return redirect()->route('frontend.finantial-document-taxes.index');
    }

    public function show(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentTax->load('item');

        return view('frontend.finantialDocumentTaxes.show', compact('finantialDocumentTax'));
    }

    public function destroy(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentTax->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinantialDocumentTaxRequest $request)
    {
        $finantialDocumentTaxes = FinantialDocumentTax::find(request('ids'));

        foreach ($finantialDocumentTaxes as $finantialDocumentTax) {
            $finantialDocumentTax->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
