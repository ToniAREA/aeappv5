<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use App\Http\Resources\Admin\AssetCategoryResource;
use App\Models\AssetCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetCategoryResource(AssetCategory::with(['authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreAssetCategoryRequest $request)
    {
        $assetCategory = AssetCategory::create($request->all());
        $assetCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $assetCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $assetCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new AssetCategoryResource($assetCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetCategoryResource($assetCategory->load(['authorized_roles', 'authorized_users']));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory)
    {
        $assetCategory->update($request->all());
        $assetCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $assetCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $assetCategory->photo || $request->input('photo') !== $assetCategory->photo->file_name) {
                if ($assetCategory->photo) {
                    $assetCategory->photo->delete();
                }
                $assetCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($assetCategory->photo) {
            $assetCategory->photo->delete();
        }

        return (new AssetCategoryResource($assetCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
