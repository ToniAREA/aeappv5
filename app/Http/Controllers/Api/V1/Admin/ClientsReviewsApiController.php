<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientsReviewRequest;
use App\Http\Requests\UpdateClientsReviewRequest;
use App\Http\Resources\Admin\ClientsReviewResource;
use App\Models\ClientsReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsReviewsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('clients_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientsReviewResource(ClientsReview::with(['boats', 'client', 'for_wlists'])->get());
    }

    public function store(StoreClientsReviewRequest $request)
    {
        $clientsReview = ClientsReview::create($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return (new ClientsReviewResource($clientsReview))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ClientsReviewResource($clientsReview->load(['boats', 'client', 'for_wlists']));
    }

    public function update(UpdateClientsReviewRequest $request, ClientsReview $clientsReview)
    {
        $clientsReview->update($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return (new ClientsReviewResource($clientsReview))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientsReview->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
