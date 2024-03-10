<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVideoTutorialRequest;
use App\Http\Requests\UpdateVideoTutorialRequest;
use App\Http\Resources\Admin\VideoTutorialResource;
use App\Models\VideoTutorial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoTutorialsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('video_tutorial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoTutorialResource(VideoTutorial::with(['subjects', 'authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreVideoTutorialRequest $request)
    {
        $videoTutorial = VideoTutorial::create($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        $videoTutorial->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoTutorial->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('image', false)) {
            $videoTutorial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new VideoTutorialResource($videoTutorial))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VideoTutorialResource($videoTutorial->load(['subjects', 'authorized_roles', 'authorized_users']));
    }

    public function update(UpdateVideoTutorialRequest $request, VideoTutorial $videoTutorial)
    {
        $videoTutorial->update($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        $videoTutorial->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoTutorial->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('image', false)) {
            if (! $videoTutorial->image || $request->input('image') !== $videoTutorial->image->file_name) {
                if ($videoTutorial->image) {
                    $videoTutorial->image->delete();
                }
                $videoTutorial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($videoTutorial->image) {
            $videoTutorial->image->delete();
        }

        return (new VideoTutorialResource($videoTutorial))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoTutorial->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
