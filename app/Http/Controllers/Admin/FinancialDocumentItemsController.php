<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FinancialDocumentItemsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('financial_document_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinancialDocumentItem::with(['financial_document', 'product'])->select(sprintf('%s.*', (new FinancialDocumentItem)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'financial_document_item_show';
                $editGate      = 'financial_document_item_edit';
                $deleteGate    = 'financial_document_item_delete';
                $crudRoutePart = 'financial-document-items';

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
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->addColumn('product_model', function ($row) {
                return $row->product ? $row->product->model : '';
            });

            $table->editColumn('product.name', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->name) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('unit_price', function ($row) {
                return $row->unit_price ? $row->unit_price : '';
            });
            $table->editColumn('line_position', function ($row) {
                return $row->line_position ? $row->line_position : '';
            });
            $table->editColumn('subtotal', function ($row) {
                return $row->subtotal ? $row->subtotal : '';
            });
            $table->editColumn('total_amount', function ($row) {
                return $row->total_amount ? $row->total_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'financial_document', 'product']);

            return $table->make(true);
        }

        return view('admin.financialDocumentItems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('financial_document_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.financialDocumentItems.create', compact('financial_documents', 'products'));
    }

    public function store(StoreFinancialDocumentItemRequest $request)
    {
        $financialDocumentItem = FinancialDocumentItem::create($request->all());

        return redirect()->route('admin.financial-document-items.index');
    }

    public function edit(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('model', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financialDocumentItem->load('financial_document', 'product');

        return view('admin.financialDocumentItems.edit', compact('financialDocumentItem', 'financial_documents', 'products'));
    }

    public function update(UpdateFinancialDocumentItemRequest $request, FinancialDocumentItem $financialDocumentItem)
    {
        $financialDocumentItem->update($request->all());

        return redirect()->route('admin.financial-document-items.index');
    }

    public function show(FinancialDocumentItem $financialDocumentItem)
    {
        abort_if(Gate::denies('financial_document_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialDocumentItem->load('financial_document', 'product', 'itemFinantialDocumentTaxes', 'itemFinantialDocumentDiscounts');

        return view('admin.financialDocumentItems.show', compact('financialDocumentItem'));
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
