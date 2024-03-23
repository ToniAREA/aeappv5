<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCheckpointsGroupRequest;
use App\Http\Requests\StoreCheckpointsGroupRequest;
use App\Http\Requests\UpdateCheckpointsGroupRequest;
use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsGroupsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoints_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroups = CheckpointsGroup::all();

        return view('frontend.checkpointsGroups.index', compact('checkpointsGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoints_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.checkpointsGroups.create');
    }

    public function store(StoreCheckpointsGroupRequest $request)
    {
        $checkpointsGroup = CheckpointsGroup::create($request->all());

        return redirect()->route('frontend.checkpoints-groups.index');
    }

    public function edit(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.checkpointsGroups.edit', compact('checkpointsGroup'));
    }

    public function update(UpdateCheckpointsGroupRequest $request, CheckpointsGroup $checkpointsGroup)
    {
        $checkpointsGroup->update($request->all());

        return redirect()->route('frontend.checkpoints-groups.index');
    }

    public function show(CheckpointsGroup $checkpointsGroup)
    {
        abort_if(Gate::denies('checkpoints_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointsGroup->load('groupCheckpoints');

        return view('frontend.checkpointsGroups.show', compact('checkpointsGroup'));
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
