<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFinantialDocumentDiscountRequest;
use App\Http\Requests\StoreFinantialDocumentDiscountRequest;
use App\Http\Requests\UpdateFinantialDocumentDiscountRequest;
use App\Models\FinancialDocumentItem;
use App\Models\FinantialDocumentDiscount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FinantialDocumentDiscountsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('finantial_document_discount_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinantialDocumentDiscount::with(['item'])->select(sprintf('%s.*', (new FinantialDocumentDiscount)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'finantial_document_discount_show';
                $editGate      = 'finantial_document_discount_edit';
                $deleteGate    = 'finantial_document_discount_delete';
                $crudRoutePart = 'finantial-document-discounts';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('discount_rate', function ($row) {
                return $row->discount_rate ? $row->discount_rate : '';
            });
            $table->editColumn('discount_amount', function ($row) {
                return $row->discount_amount ? $row->discount_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'item']);

            return $table->make(true);
        }

        return view('admin.finantialDocumentDiscounts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('finantial_document_discount_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finantialDocumentDiscounts.create', compact('items'));
    }

    public function store(StoreFinantialDocumentDiscountRequest $request)
    {
        $finantialDocumentDiscount = FinantialDocumentDiscount::create($request->all());

        return redirect()->route('admin.finantial-document-discounts.index');
    }

    public function edit(FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        abort_if(Gate::denies('finantial_document_discount_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = FinancialDocumentItem::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finantialDocumentDiscount->load('item');

        return view('admin.finantialDocumentDiscounts.edit', compact('finantialDocumentDiscount', 'items'));
    }

    public function update(UpdateFinantialDocumentDiscountRequest $request, FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        $finantialDocumentDiscount->update($request->all());

        return redirect()->route('admin.finantial-document-discounts.index');
    }

    public function show(FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        abort_if(Gate::denies('finantial_document_discount_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentDiscount->load('item');

        return view('admin.finantialDocumentDiscounts.show', compact('finantialDocumentDiscount'));
    }

    public function destroy(FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        abort_if(Gate::denies('finantial_document_discount_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentDiscount->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinantialDocumentDiscountRequest $request)
    {
        $finantialDocumentDiscounts = FinantialDocumentDiscount::find(request('ids'));

        foreach ($finantialDocumentDiscounts as $finantialDocumentDiscount) {
            $finantialDocumentDiscount->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
