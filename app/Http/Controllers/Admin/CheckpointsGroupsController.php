<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCheckpointsGroupRequest;
use App\Http\Requests\StoreCheckpointsGroupRequest;
use App\Http\Requests\UpdateCheckpointsGroupRequest;
use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsGroupsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoints_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroups = CheckpointsGroup::with(['media'])->get();

        return view('admin.checkpointsGroups.index', compact('checkpointsGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoints_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpointsGroups.create');
    }

    public function store(StoreCheckpointsGroupRequest $request)
    {
        $checkpointsGroup = CheckpointsGroup::create($request->all());

        if ($request->input('photo', false)) {
            $checkpointsGroup->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $checkpointsGroup->id]);
        }

        return redirect()->route('admin.checkpoints-groups.index');
    }

    public function edit(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpointsGroups.edit', compact('checkpointsGroup'));
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

        return redirect()->route('admin.checkpoints-groups.index');
    }

    public function show(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroup->load('groupCheckpoints');

        return view('admin.checkpointsGroups.show', compact('checkpointsGroup'));
    }

    public function destroy(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckpointsGroupRequest $request)
    {
        $checkpointsGroups = CheckpointsGroup::find(request('ids'));

        foreach ($checkpointsGroups as $checkpointsGroup) {
            $checkpointsGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('checkpoints_group_create') && Gate::denies('checkpoints_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CheckpointsGroup();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
