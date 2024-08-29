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

class FinantialDocumentDiscountsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('finantial_document_discount_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentDiscounts = FinantialDocumentDiscount::with(['item'])->get();

        return view('admin.finantialDocumentDiscounts.index', compact('finantialDocumentDiscounts'));
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
