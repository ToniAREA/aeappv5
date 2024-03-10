<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinantialDocumentDiscountRequest;
use App\Http\Requests\UpdateFinantialDocumentDiscountRequest;
use App\Http\Resources\Admin\FinantialDocumentDiscountResource;
use App\Models\FinantialDocumentDiscount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinantialDocumentDiscountsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finantial_document_discount_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinantialDocumentDiscountResource(FinantialDocumentDiscount::with(['item'])->get());
    }

    public function store(StoreFinantialDocumentDiscountRequest $request)
    {
        $finantialDocumentDiscount = FinantialDocumentDiscount::create($request->all());

        return (new FinantialDocumentDiscountResource($finantialDocumentDiscount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        abort_if(Gate::denies('finantial_document_discount_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinantialDocumentDiscountResource($finantialDocumentDiscount->load(['item']));
    }

    public function update(UpdateFinantialDocumentDiscountRequest $request, FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        $finantialDocumentDiscount->update($request->all());

        return (new FinantialDocumentDiscountResource($finantialDocumentDiscount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinantialDocumentDiscount $finantialDocumentDiscount)
    {
        abort_if(Gate::denies('finantial_document_discount_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finantialDocumentDiscount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
