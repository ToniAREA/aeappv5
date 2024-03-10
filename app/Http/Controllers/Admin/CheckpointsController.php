<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCheckpointRequest;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use App\Models\Checkpoint;
use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CheckpointsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Checkpoint::with(['groups'])->select(sprintf('%s.*', (new Checkpoint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'checkpoint_show';
                $editGate      = 'checkpoint_edit';
                $deleteGate    = 'checkpoint_delete';
                $crudRoutePart = 'checkpoints';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('group', function ($row) {
                $labels = [];
                foreach ($row->groups as $group) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $group->group);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('is_available', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_available ? 'checked' : null) . '>';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'group', 'is_available', 'file', 'photo']);

            return $table->make(true);
        }

        return view('admin.checkpoints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = CheckpointsGroup::pluck('group', 'id');

        return view('admin.checkpoints.create', compact('groups'));
    }

    public function store(StoreCheckpointRequest $request)
    {
        $checkpoint = Checkpoint::create($request->all());
        $checkpoint->groups()->sync($request->input('groups', []));
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

        $groups = CheckpointsGroup::pluck('group', 'id');

        $checkpoint->load('groups');

        return view('admin.checkpoints.edit', compact('checkpoint', 'groups'));
    }

    public function update(UpdateCheckpointRequest $request, Checkpoint $checkpoint)
    {
        $checkpoint->update($request->all());
        $checkpoint->groups()->sync($request->input('groups', []));
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

        $checkpoint->load('groups', 'checkpointsCarePlans');

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
