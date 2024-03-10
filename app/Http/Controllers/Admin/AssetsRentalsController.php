<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssetsRentalRequest;
use App\Http\Requests\StoreAssetsRentalRequest;
use App\Http\Requests\UpdateAssetsRentalRequest;
use App\Models\Asset;
use App\Models\AssetsRental;
use App\Models\Boat;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetsRentalsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('assets_rental_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssetsRental::with(['asset', 'user', 'client', 'financial_document', 'boat'])->select(sprintf('%s.*', (new AssetsRental)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'assets_rental_show';
                $editGate      = 'assets_rental_edit';
                $deleteGate    = 'assets_rental_delete';
                $crudRoutePart = 'assets-rentals';

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
            $table->addColumn('asset_name', function ($row) {
                return $row->asset ? $row->asset->name : '';
            });

            $table->editColumn('asset.data_1', function ($row) {
                return $row->asset ? (is_string($row->asset) ? $row->asset : $row->asset->data_1) : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('boat.boat_type', function ($row) {
                return $row->boat ? (is_string($row->boat) ? $row->boat : $row->boat->boat_type) : '';
            });

            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : '';
            });
            $table->editColumn('rental_details', function ($row) {
                return $row->rental_details ? $row->rental_details : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('invoiced', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->invoiced ? 'checked' : null) . '>';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });

            $table->editColumn('rental_unit', function ($row) {
                return $row->rental_unit ? AssetsRental::RENTAL_UNIT_SELECT[$row->rental_unit] : '';
            });
            $table->editColumn('rental_quantity', function ($row) {
                return $row->rental_quantity ? $row->rental_quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'asset', 'user', 'client', 'financial_document', 'boat', 'active', 'invoiced']);

            return $table->make(true);
        }

        return view('admin.assetsRentals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('assets_rental_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assetsRentals.create', compact('assets', 'boats', 'clients', 'financial_documents', 'users'));
    }

    public function store(StoreAssetsRentalRequest $request)
    {
        $assetsRental = AssetsRental::create($request->all());

        return redirect()->route('admin.assets-rentals.index');
    }

    public function edit(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assetsRental->load('asset', 'user', 'client', 'financial_document', 'boat');

        return view('admin.assetsRentals.edit', compact('assets', 'assetsRental', 'boats', 'clients', 'financial_documents', 'users'));
    }

    public function update(UpdateAssetsRentalRequest $request, AssetsRental $assetsRental)
    {
        $assetsRental->update($request->all());

        return redirect()->route('admin.assets-rentals.index');
    }

    public function show(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsRental->load('asset', 'user', 'client', 'financial_document', 'boat');

        return view('admin.assetsRentals.show', compact('assetsRental'));
    }

    public function destroy(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsRental->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetsRentalRequest $request)
    {
        $assetsRentals = AssetsRental::find(request('ids'));

        foreach ($assetsRentals as $assetsRental) {
            $assetsRental->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
