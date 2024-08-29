<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinalcialDocumentRequest;
use App\Http\Requests\UpdateFinalcialDocumentRequest;
use App\Http\Resources\Admin\FinalcialDocumentResource;
use App\Models\FinalcialDocument;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalcialDocumentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finalcial_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalcialDocumentResource(FinalcialDocument::with(['client', 'currency'])->get());
    }

    public function store(StoreFinalcialDocumentRequest $request)
    {
        $finalcialDocument = FinalcialDocument::create($request->all());

        return (new FinalcialDocumentResource($finalcialDocument))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalcialDocumentResource($finalcialDocument->load(['client', 'currency']));
    }

    public function update(UpdateFinalcialDocumentRequest $request, FinalcialDocument $finalcialDocument)
    {
        $finalcialDocument->update($request->all());

        return (new FinalcialDocumentResource($finalcialDocument))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinalcialDocument $finalcialDocument)
    {
        abort_if(Gate::denies('finalcial_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalcialDocument->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
