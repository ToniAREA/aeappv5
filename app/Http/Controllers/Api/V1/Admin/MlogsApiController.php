<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Http\Resources\Admin\MlogResource;
use App\Models\Mlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MlogsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MlogResource(Mlog::with(['boat', 'wlist', 'employee', 'product', 'proforma_number'])->get());
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $mlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        return (new MlogResource($mlog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MlogResource($mlog->load(['boat', 'wlist', 'employee', 'product', 'proforma_number']));
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

        return (new MlogResource($mlog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
