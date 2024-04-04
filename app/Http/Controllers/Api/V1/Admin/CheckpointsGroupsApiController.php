<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCheckpointsGroupRequest;
use App\Http\Requests\UpdateCheckpointsGroupRequest;
use App\Http\Resources\Admin\CheckpointsGroupResource;
use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsGroupsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoints_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointsGroupResource(CheckpointsGroup::all());
    }

    public function store(StoreCheckpointsGroupRequest $request)
    {
        $checkpointsGroup = CheckpointsGroup::create($request->all());

        if ($request->input('photo', false)) {
            $checkpointsGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new CheckpointsGroupResource($checkpointsGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointsGroupResource($checkpointsGroup);
    }

    public function update(UpdateCheckpointsGroupRequest $request, CheckpointsGroup $checkpointsGroup)
    {
        $checkpointsGroup->update($request->all());

        if ($request->input('photo', false)) {
            if (! $checkpointsGroup->photo || $request->input('photo') !== $checkpointsGroup->photo->file_name) {
                if ($checkpointsGroup->photo) {
                    $checkpointsGroup->photo->delete();
                }
                $checkpointsGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($checkpointsGroup->photo) {
            $checkpointsGroup->photo->delete();
        }

        return (new CheckpointsGroupResource($checkpointsGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
