<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FinantialDocumentTaxesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('finantial_document_tax_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinantialDocumentTax::with(['item'])->select(sprintf('%s.*', (new FinantialDocumentTax)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'finantial_document_tax_show';
                $editGate      = 'finantial_document_tax_edit';
                $deleteGate    = 'finantial_document_tax_delete';
                $crudRoutePart = 'finantial-document-taxes';

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
            $table->addColumn('item_description', function ($row) {
                return $row->item ? $row->item->description : '';
            });

            $table->editColumn('item.subtotal', function ($row) {
                return $row->item ? (is_string($row->item) ? $row->item : $row->item->subtotal) : '';
            });
            $table->editColumn('tax_type', function ($row) {
                return $row->tax_type ? FinantialDocumentTax::TAX_TYPE_RADIO[$row->tax_type] : '';
            });
            $table->editColumn('tax_rate', function ($row) {
                return $row->tax_rate ? $row->tax_rate : '';
            });
            $table->editColumn('tax_amount', function ($row) {
                return $row->tax_amount ? $row->tax_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'item']);

            return $table->make(true);
        }

        return view('admin.finantialDocumentTaxes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('finantial_document_tax_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finantialDocumentTaxes.create', compact('items'));
    }

    public function store(StoreFinantialDocumentTaxRequest $request)
    {
        $finantialDocumentTax = FinantialDocumentTax::create($request->all());

        return redirect()->route('admin.finantial-document-taxes.index');
    }

    public function edit(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finantialDocumentTax->load('item');

        return view('admin.finantialDocumentTaxes.edit', compact('finantialDocumentTax', 'items'));
    }

    public function update(UpdateFinantialDocumentTaxRequest $request, FinantialDocumentTax $finantialDocumentTax)
    {
        $finantialDocumentTax->update($request->all());

        return redirect()->route('admin.finantial-document-taxes.index');
    }

    public function show(FinantialDocumentTax $finantialDocumentTax)
    {
        abort_if(Gate::denies('finantial_document_tax_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentTax->load('item');

        return view('admin.finantialDocumentTaxes.show', compact('finantialDocumentTax'));
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
