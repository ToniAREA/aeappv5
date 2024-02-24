<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientsReviewRequest;
use App\Http\Requests\StoreClientsReviewRequest;
use App\Http\Requests\UpdateClientsReviewRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\ClientsReview;
use App\Models\Proforma;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsReviewsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('clients_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientsReviews = ClientsReview::with(['boats', 'client', 'proforma', 'for_wlists'])->get();

        return view('frontend.clientsReviews.index', compact('clientsReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('clients_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proformas = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('deadline', 'id');

        return view('frontend.clientsReviews.create', compact('boats', 'clients', 'for_wlists', 'proformas'));
    }

    public function store(StoreClientsReviewRequest $request)
    {
        $clientsReview = ClientsReview::create($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return redirect()->route('frontend.clients-reviews.index');
    }

    public function edit(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proformas = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('deadline', 'id');

        $clientsReview->load('boats', 'client', 'proforma', 'for_wlists');

        return view('frontend.clientsReviews.edit', compact('boats', 'clients', 'clientsReview', 'for_wlists', 'proformas'));
    }

    public function update(UpdateClientsReviewRequest $request, ClientsReview $clientsReview)
    {
        $clientsReview->update($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return redirect()->route('frontend.clients-reviews.index');
    }

    public function show(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientsReview->load('boats', 'client', 'proforma', 'for_wlists');

        return view('frontend.clientsReviews.show', compact('clientsReview'));
    }

    public function destroy(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientsReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientsReviewRequest $request)
    {
        $clientsReviews = ClientsReview::find(request('ids'));

        foreach ($clientsReviews as $clientsReview) {
            $clientsReview->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
