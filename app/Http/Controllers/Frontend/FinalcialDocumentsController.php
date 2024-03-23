<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFinalcialDocumentRequest;
use App\Http\Requests\StoreFinalcialDocumentRequest;
use App\Http\Requests\UpdateFinalcialDocumentRequest;
use App\Models\Client;
use App\Models\Currency;
use App\Models\FinalcialDocument;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalcialDocumentsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('finalcial_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalcialDocuments = FinalcialDocument::with(['client', 'currency'])->get();

        return view('frontend.finalcialDocuments.index', compact('finalcialDocuments'));
    }

    public function create()
    {
        abort_if(Gate::denies('finalcial_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.finalcialDocuments.create', compact('clients', 'currencies'));
    }

    public function store(StoreFinalcialDocumentRequest $request)
    {
        $finalcialDocument = FinalcialDocument::create($request->all());

        return redirect()->route('frontend.finalcial-documents.index');
    }

    public function edit(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalcialDocument->load('client', 'currency');

        return view('frontend.finalcialDocuments.edit', compact('clients', 'currencies', 'finalcialDocument'));
    }

    public function update(UpdateFinalcialDocumentRequest $request, FinalcialDocument $finalcialDocument)
    {
        $finalcialDocument->update($request->all());

        return redirect()->route('frontend.finalcial-documents.index');
    }

    public function show(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalcialDocument->load('client', 'currency', 'financialDocumentFinancialDocumentItems', 'financialDocumentPayments', 'financialDocumentAssetsRentals', 'financialDocumentWlists', 'financialDocumentWlogs', 'financialDocumentMlogs', 'financialDocumentBookingLists', 'financialDocumentSuscriptions', 'financialDocumentMaintenanceSuscriptions', 'financialDocumentIotSuscriptions');

        return view('frontend.finalcialDocuments.show', compact('finalcialDocument'));
    }

    public function destroy(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalcialDocument->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinalcialDocumentRequest $request)
    {
        $finalcialDocuments = FinalcialDocument::find(request('ids'));

        foreach ($finalcialDocuments as $finalcialDocument) {
            $finalcialDocument->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
