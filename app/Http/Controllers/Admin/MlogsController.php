<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMlogRequest;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Models\Boat;
use App\Models\FinalcialDocument;
use App\Models\Mlog;
use App\Models\Product;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MlogsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlogs = Mlog::with(['boat', 'wlist', 'employee', 'product', 'financial_document', 'media'])->get();

        $boats = Boat::get();

        $wlists = Wlist::get();

        $users = User::get();

        $products = Product::get();

        $finalcial_documents = FinalcialDocument::get();

        return view('admin.mlogs.index', compact('boats', 'finalcial_documents', 'mlogs', 'products', 'users', 'wlists'));
    }

    public function create()
    {
        abort_if(Gate::denies('mlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mlogs.create', compact('boats', 'employees', 'financial_documents', 'products', 'wlists'));
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $mlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mlog->id]);
        }

        return redirect()->route('admin.mlogs.index');
    }

    public function edit(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mlog->load('boat', 'wlist', 'employee', 'product', 'financial_document');

        return view('admin.mlogs.edit', compact('boats', 'employees', 'financial_documents', 'mlog', 'products', 'wlists'));
    }

    public function update(UpdateMlogRequest $request, Mlog $mlog)
    {
        $mlog->update($request->all());

        if (count($mlog->photos) > 0) {
            foreach ($mlog->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mlog->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.mlogs.index');
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->load('boat', 'wlist', 'employee', 'product', 'financial_document');

        return view('admin.mlogs.show', compact('mlog'));
    }

    public function destroy(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyMlogRequest $request)
    {
        $mlogs = Mlog::find(request('ids'));

        foreach ($mlogs as $mlog) {
            $mlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mlog_create') && Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Mlog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
