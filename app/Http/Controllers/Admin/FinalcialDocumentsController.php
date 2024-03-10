<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FinalcialDocumentsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('finalcial_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinalcialDocument::with(['client', 'currency'])->select(sprintf('%s.*', (new FinalcialDocument)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'finalcial_document_show';
                $editGate      = 'finalcial_document_edit';
                $deleteGate    = 'finalcial_document_delete';
                $crudRoutePart = 'finalcial-documents';

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
            $table->editColumn('doc_type', function ($row) {
                return $row->doc_type ? FinalcialDocument::DOC_TYPE_RADIO[$row->doc_type] : '';
            });
            $table->editColumn('reference_number', function ($row) {
                return $row->reference_number ? $row->reference_number : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? FinalcialDocument::STATUS_RADIO[$row->status] : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });

            $table->addColumn('currency_code', function ($row) {
                return $row->currency ? $row->currency->code : '';
            });

            $table->editColumn('currency.name', function ($row) {
                return $row->currency ? (is_string($row->currency) ? $row->currency : $row->currency->name) : '';
            });
            $table->editColumn('subtotal', function ($row) {
                return $row->subtotal ? $row->subtotal : '';
            });
            $table->editColumn('total_taxes', function ($row) {
                return $row->total_taxes ? $row->total_taxes : '';
            });
            $table->editColumn('total_discounts', function ($row) {
                return $row->total_discounts ? $row->total_discounts : '';
            });
            $table->editColumn('total_amount', function ($row) {
                return $row->total_amount ? $row->total_amount : '';
            });
            $table->editColumn('payment_terms', function ($row) {
                return $row->payment_terms ? $row->payment_terms : '';
            });
            $table->editColumn('security_code', function ($row) {
                return $row->security_code ? $row->security_code : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'currency']);

            return $table->make(true);
        }

        return view('admin.finalcialDocuments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('finalcial_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finalcialDocuments.create', compact('clients', 'currencies'));
    }

    public function store(StoreFinalcialDocumentRequest $request)
    {
        $finalcialDocument = FinalcialDocument::create($request->all());

        return redirect()->route('admin.finalcial-documents.index');
    }

    public function edit(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalcialDocument->load('client', 'currency');

        return view('admin.finalcialDocuments.edit', compact('clients', 'currencies', 'finalcialDocument'));
    }

    public function update(UpdateFinalcialDocumentRequest $request, FinalcialDocument $finalcialDocument)
    {
        $finalcialDocument->update($request->all());

        return redirect()->route('admin.finalcial-documents.index');
    }

    public function show(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalcialDocument->load('client', 'currency', 'financialDocumentFinancialDocumentItems', 'financialDocumentPayments', 'financialDocumentAssetsRentals', 'financialDocumentWlists', 'financialDocumentWlogs', 'financialDocumentMlogs', 'financialDocumentBookingLists', 'financialDocumentSuscriptions', 'financialDocumentMaintenanceSuscriptions', 'financialDocumentIotSuscriptions');

        return view('admin.finalcialDocuments.show', compact('finalcialDocument'));
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
