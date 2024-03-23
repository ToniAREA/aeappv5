<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWlogRequest;
use App\Http\Requests\StoreWlogRequest;
use App\Http\Requests\UpdateWlogRequest;
use App\Models\FinalcialDocument;
use App\Models\Marina;
use App\Models\User;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WlogsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('wlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlogs = Wlog::with(['wlist', 'employee', 'marina', 'financial_document', 'media'])->get();

        $wlists = Wlist::get();

        $users = User::get();

        $marinas = Marina::get();

        $finalcial_documents = FinalcialDocument::get();

        return view('admin.wlogs.index', compact('finalcial_documents', 'marinas', 'users', 'wlists', 'wlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlogs.create', compact('employees', 'financial_documents', 'marinas', 'wlists'));
    }

    public function store(StoreWlogRequest $request)
    {
        $wlog = Wlog::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $wlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $wlog->id]);
        }

        return redirect()->route('admin.wlogs.index');
    }

    public function edit(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlog->load('wlist', 'employee', 'marina', 'financial_document');

        return view('admin.wlogs.edit', compact('employees', 'financial_documents', 'marinas', 'wlists', 'wlog'));
    }

    public function update(UpdateWlogRequest $request, Wlog $wlog)
    {
        $wlog->update($request->all());

        if (count($wlog->photos) > 0) {
            foreach ($wlog->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $wlog->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $wlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.wlogs.index');
    }

    public function show(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->load('wlist', 'employee', 'marina', 'financial_document', 'forWlogEmployeeRatings');

        return view('admin.wlogs.show', compact('wlog'));
    }

    public function destroy(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlogRequest $request)
    {
        $wlogs = Wlog::find(request('ids'));

        foreach ($wlogs as $wlog) {
            $wlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('wlog_create') && Gate::denies('wlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Wlog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
