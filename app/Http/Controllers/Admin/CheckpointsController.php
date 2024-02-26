<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCheckpointRequest;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use App\Models\Checkpoint;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoints = Checkpoint::with(['media'])->get();

        return view('admin.checkpoints.index', compact('checkpoints'));
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpoints.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $checkpoint->id]);
        }

        return redirect()->route('admin.checkpoints.index');
    }

    public function edit(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpoints.edit', compact('checkpoint'));
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

        return redirect()->route('admin.checkpoints.index');
    }

    public function show(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->load('checkpointsCarePlans');

        return view('admin.checkpoints.show', compact('checkpoint'));
    }

    public function destroy(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckpointRequest $request)
    {
        $checkpoints = Checkpoint::find(request('ids'));

        foreach ($checkpoints as $checkpoint) {
            $checkpoint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('checkpoint_create') && Gate::denies('checkpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Checkpoint();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
