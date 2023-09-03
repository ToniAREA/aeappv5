<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreContentPageRequest;
use App\Http\Requests\UpdateContentPageRequest;
use App\Http\Resources\Admin\ContentPageResource;
use App\Models\ContentPage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentPageApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('content_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContentPageResource(ContentPage::with(['categories', 'tags'])->get());
    }

    public function store(StoreContentPageRequest $request)
    {
        $contentPage = ContentPage::create($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        foreach ($request->input('featured_image', []) as $file) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('featured_image');
        }

        foreach ($request->input('file', []) as $file) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        return (new ContentPageResource($contentPage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContentPageResource($contentPage->load(['categories', 'tags']));
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage)
    {
        $contentPage->update($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        if (count($contentPage->featured_image) > 0) {
            foreach ($contentPage->featured_image as $media) {
                if (! in_array($media->file_name, $request->input('featured_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contentPage->featured_image->pluck('file_name')->toArray();
        foreach ($request->input('featured_image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('featured_image');
            }
        }

        if (count($contentPage->file) > 0) {
            foreach ($contentPage->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contentPage->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return (new ContentPageResource($contentPage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
