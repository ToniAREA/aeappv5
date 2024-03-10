<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetsHistoryRequest;
use App\Http\Requests\UpdateAssetsHistoryRequest;
use App\Http\Resources\Admin\AssetsHistoryResource;
use App\Models\AssetsHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetsHistoryResource(AssetsHistory::with(['asset', 'status', 'location', 'assigned_user'])->get());
    }

    public function store(StoreAssetsHistoryRequest $request)
    {
        $assetsHistory = AssetsHistory::create($request->all());

        return (new AssetsHistoryResource($assetsHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetsHistoryResource($assetsHistory->load(['asset', 'status', 'location', 'assigned_user']));
    }

    public function update(UpdateAssetsHistoryRequest $request, AssetsHistory $assetsHistory)
    {
        $assetsHistory->update($request->all());

        return (new AssetsHistoryResource($assetsHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
