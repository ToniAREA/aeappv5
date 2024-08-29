<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlistStatusRequest;
use App\Http\Requests\StoreWlistStatusRequest;
use App\Http\Requests\UpdateWlistStatusRequest;
use App\Models\WlistStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlistStatusesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('wlist_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlistStatuses = WlistStatus::all();

        return view('admin.wlistStatuses.index', compact('wlistStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wlistStatuses.create');
    }

    public function store(StoreWlistStatusRequest $request)
    {
        $wlistStatus = WlistStatus::create($request->all());

        return redirect()->route('admin.wlist-statuses.index');
    }

    public function edit(WlistStatus $wlistStatus)
    {
        abort_if(Gate::denies('wlist_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wlistStatuses.edit', compact('wlistStatus'));
    }

    public function update(UpdateWlistStatusRequest $request, WlistStatus $wlistStatus)
    {
        $wlistStatus->update($request->all());

        return redirect()->route('admin.wlist-statuses.index');
    }

    public function show(WlistStatus $wlistStatus)
    {
        abort_if(Gate::denies('wlist_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wlistStatuses.show', compact('wlistStatus'));
    }

    public function destroy(WlistStatus $wlistStatus)
    {
        abort_if(Gate::denies('wlist_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlistStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlistStatusRequest $request)
    {
        $wlistStatuses = WlistStatus::find(request('ids'));

        foreach ($wlistStatuses as $wlistStatus) {
            $wlistStatus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
