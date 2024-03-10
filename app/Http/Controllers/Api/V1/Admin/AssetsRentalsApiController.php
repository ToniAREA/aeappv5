<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetsRentalRequest;
use App\Http\Requests\UpdateAssetsRentalRequest;
use App\Http\Resources\Admin\AssetsRentalResource;
use App\Models\AssetsRental;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsRentalsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assets_rental_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetsRentalResource(AssetsRental::with(['asset', 'user', 'client', 'boat', 'financial_document'])->get());
    }

    public function store(StoreAssetsRentalRequest $request)
    {
        $assetsRental = AssetsRental::create($request->all());

        return (new AssetsRentalResource($assetsRental))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetsRentalResource($assetsRental->load(['asset', 'user', 'client', 'boat', 'financial_document']));
    }

    public function update(UpdateAssetsRentalRequest $request, AssetsRental $assetsRental)
    {
        $assetsRental->update($request->all());

        return (new AssetsRentalResource($assetsRental))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetsRental $assetsRental)
    {
        abort_if(Gate::denies('assets_rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsRental->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
