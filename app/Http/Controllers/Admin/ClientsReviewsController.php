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
use Yajra\DataTables\Facades\DataTables;

class ClientsReviewsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('clients_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientsReview::with(['boats', 'client', 'for_wlists'])->select(sprintf('%s.*', (new ClientsReview)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'clients_review_show';
                $editGate      = 'clients_review_edit';
                $deleteGate    = 'clients_review_delete';
                $crudRoutePart = 'clients-reviews';

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
            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->editColumn('for_wlists', function ($row) {
                $labels = [];
                foreach ($row->for_wlists as $for_wlist) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $for_wlist->deadline);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });
            $table->editColumn('shown_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->shown_online ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'boats', 'client', 'for_wlists', 'shown_online']);

            return $table->make(true);
        }

        return view('admin.clientsReviews.index');
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
