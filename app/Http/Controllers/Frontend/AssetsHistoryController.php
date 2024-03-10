<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssetsHistoryRequest;
use App\Http\Requests\StoreAssetsHistoryRequest;
use App\Http\Requests\UpdateAssetsHistoryRequest;
use App\Models\AssetsHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsHistoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistories = AssetsHistory::with(['asset', 'status', 'location', 'assigned_user'])->get();

        return view('frontend.assetsHistories.index', compact('assetsHistories'));
    }

    public function create()
    {
        abort_if(Gate::denies('assets_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.assetsHistories.create');
    }

    public function store(StoreAssetsHistoryRequest $request)
    {
        $assetsHistory = AssetsHistory::create($request->all());

        return redirect()->route('frontend.assets-histories.index');
    }

    public function edit(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->load('asset', 'status', 'location', 'assigned_user');

        return view('frontend.assetsHistories.edit', compact('assetsHistory'));
    }

    public function update(UpdateAssetsHistoryRequest $request, AssetsHistory $assetsHistory)
    {
        $assetsHistory->update($request->all());

        return redirect()->route('frontend.assets-histories.index');
    }

    public function show(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->load('asset', 'status', 'location', 'assigned_user');

        return view('frontend.assetsHistories.show', compact('assetsHistory'));
    }

    public function destroy(AssetsHistory $assetsHistory)
    {
        abort_if(Gate::denies('assets_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetsHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetsHistoryRequest $request)
    {
        $assetsHistories = AssetsHistory::find(request('ids'));

        foreach ($assetsHistories as $assetsHistory) {
            $assetsHistory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
