<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Currency;
use App\Models\FinalcialDocument;
use App\Models\Payment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Payment::with(['financial_document', 'currency'])->select(sprintf('%s.*', (new Payment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'payment_show';
                $editGate      = 'payment_edit';
                $deleteGate    = 'payment_delete';
                $crudRoutePart = 'payments';

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
            $table->editColumn('payment_gateway', function ($row) {
                return $row->payment_gateway ? $row->payment_gateway : '';
            });
            $table->editColumn('id_transaction', function ($row) {
                return $row->id_transaction ? $row->id_transaction : '';
            });
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->editColumn('total_amount', function ($row) {
                return $row->total_amount ? $row->total_amount : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->addColumn('currency_code', function ($row) {
                return $row->currency ? $row->currency->code : '';
            });

            $table->editColumn('currency.name', function ($row) {
                return $row->currency ? (is_string($row->currency) ? $row->currency : $row->currency->name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'financial_document', 'currency']);

            return $table->make(true);
        }

        return view('admin.payments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payments.create', compact('currencies', 'financial_documents'));
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());

        return redirect()->route('admin.payments.index');
    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment->load('financial_document', 'currency');

        return view('admin.payments.edit', compact('currencies', 'financial_documents', 'payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('admin.payments.index');
    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('financial_document', 'currency');

        return view('admin.payments.show', compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentRequest $request)
    {
        $payments = Payment::find(request('ids'));

        foreach ($payments as $payment) {
            $payment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
