<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use App\Http\Resources\Admin\CheckpointResource;
use App\Models\Checkpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointResource(Checkpoint::all());
    }

    public function store(StoreCheckpointRequest $request)
    {
        $checkpoint = Checkpoint::create($request->all());

        if ($request->input('file', false)) {
            $checkpoint->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($request->input('photo', false)) {
            $checkpoint->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new CheckpointResource($checkpoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointResource($checkpoint);
    }

    public function update(UpdateCheckpointRequest $request, Checkpoint $checkpoint)
    {
        $checkpoint->update($request->all());

        if ($request->input('file', false)) {
            if (! $checkpoint->file || $request->input('file') !== $checkpoint->file->file_name) {
                if ($checkpoint->file) {
                    $checkpoint->file->delete();
                }
                $checkpoint->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($checkpoint->file) {
            $checkpoint->file->delete();
        }

        if ($request->input('photo', false)) {
            if (! $checkpoint->photo || $request->input('photo') !== $checkpoint->photo->file_name) {
                if ($checkpoint->photo) {
                    $checkpoint->photo->delete();
                }
                $checkpoint->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($checkpoint->photo) {
            $checkpoint->photo->delete();
        }

        return (new CheckpointResource($checkpoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
