<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetsRentalRequest;
use App\Http\Requests\StoreAssetsRentalRequest;
use App\Http\Requests\UpdateAssetsRentalRequest;
use App\Models\Asset;
use App\Models\AssetsRental;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Proforma;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsRentalsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assets_rental_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsRentals = AssetsRental::with(['asset', 'user', 'client', 'boat', 'proforma'])->get();

        return view('admin.assetsRentals.index', compact('assetsRentals'));
    }

    public function create()
    {
        abort_if(Gate::denies('assets_rental_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proformas = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assetsRentals.create', compact('assets', 'boats', 'clients', 'proformas', 'users'));
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

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proformas = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assetsRental->load('asset', 'user', 'client', 'boat', 'proforma');

        return view('admin.assetsRentals.edit', compact('assets', 'assetsRental', 'boats', 'clients', 'proformas', 'users'));
    }

    public function update(UpdateAssetsRentalRequest $request, AssetsRental $assetsRental)
    {
        $assetsRental->update($request->all());

        return redirect()->route('admin.assets-rentals.index');
    }

    public function show(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsRental->load('asset', 'user', 'client', 'boat', 'proforma');

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
