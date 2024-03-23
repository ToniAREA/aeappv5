<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVideoCategoryRequest;
use App\Http\Requests\UpdateVideoCategoryRequest;
use App\Http\Resources\Admin\VideoCategoryResource;
use App\Models\VideoCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoCategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('video_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoCategoryResource(VideoCategory::with(['authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreVideoCategoryRequest $request)
    {
        $videoCategory = VideoCategory::create($request->all());
        $videoCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $videoCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new VideoCategoryResource($videoCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VideoCategory $videoCategory)
    {
        abort_if(Gate::denies('video_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoCategoryResource($videoCategory->load(['authorized_roles', 'authorized_users']));
    }

    public function update(UpdateVideoCategoryRequest $request, VideoCategory $videoCategory)
    {
        $videoCategory->update($request->all());
        $videoCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $videoCategory->photo || $request->input('photo') !== $videoCategory->photo->file_name) {
                if ($videoCategory->photo) {
                    $videoCategory->photo->delete();
                }
                $videoCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($videoCategory->photo) {
            $videoCategory->photo->delete();
        }

        return (new VideoCategoryResource($videoCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VideoCategory $videoCategory)
    {
        abort_if(Gate::denies('video_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
