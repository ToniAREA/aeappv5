<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCheckpointsGroupRequest;
use App\Http\Requests\StoreCheckpointsGroupRequest;
use App\Http\Requests\UpdateCheckpointsGroupRequest;
use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CheckpointsGroupsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('checkpoints_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CheckpointsGroup::query()->select(sprintf('%s.*', (new CheckpointsGroup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'checkpoints_group_show';
                $editGate      = 'checkpoints_group_edit';
                $deleteGate    = 'checkpoints_group_delete';
                $crudRoutePart = 'checkpoints-groups';

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
            $table->editColumn('group', function ($row) {
                return $row->group ? $row->group : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.checkpointsGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoints_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpointsGroups.create');
    }

    public function store(StoreCheckpointsGroupRequest $request)
    {
        $checkpointsGroup = CheckpointsGroup::create($request->all());

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
}
