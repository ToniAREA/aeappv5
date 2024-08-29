<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientsReviewRequest;
use App\Http\Requests\StoreClientsReviewRequest;
use App\Http\Requests\UpdateClientsReviewRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\ClientsReview;
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

        $clientsReviews = ClientsReview::with(['boats', 'client', 'for_wlists'])->get();

        return view('admin.clientsReviews.index', compact('clientsReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('clients_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('deadline', 'id');

        return view('admin.clientsReviews.create', compact('boats', 'clients', 'for_wlists'));
    }

    public function store(StoreClientsReviewRequest $request)
    {
        $clientsReview = ClientsReview::create($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return redirect()->route('admin.clients-reviews.index');
    }

    public function edit(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('deadline', 'id');

        $clientsReview->load('boats', 'client', 'for_wlists');

        return view('admin.clientsReviews.edit', compact('boats', 'clients', 'clientsReview', 'for_wlists'));
    }

    public function update(UpdateClientsReviewRequest $request, ClientsReview $clientsReview)
    {
        $clientsReview->update($request->all());
        $clientsReview->boats()->sync($request->input('boats', []));
        $clientsReview->for_wlists()->sync($request->input('for_wlists', []));

        return redirect()->route('admin.clients-reviews.index');
    }

    public function show(ClientsReview $clientsReview)
    {
        abort_if(Gate::denies('clients_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientsReview->load('boats', 'client', 'for_wlists');

        return view('admin.clientsReviews.show', compact('clientsReview'));
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
