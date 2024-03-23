<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVideoCategoryRequest;
use App\Http\Requests\StoreVideoCategoryRequest;
use App\Http\Requests\UpdateVideoCategoryRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\VideoCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VideoCategoriesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('video_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoCategories = VideoCategory::with(['authorized_roles', 'authorized_users', 'media'])->get();

        return view('admin.videoCategories.index', compact('videoCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('video_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.videoCategories.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreVideoCategoryRequest $request)
    {
        $videoCategory = VideoCategory::create($request->all());
        $videoCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $videoCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $videoCategory->id]);
        }

        return redirect()->route('admin.video-categories.index');
    }

    public function edit(VideoCategory $videoCategory)
    {
        abort_if(Gate::denies('video_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $videoCategory->load('authorized_roles', 'authorized_users');

        return view('admin.videoCategories.edit', compact('authorized_roles', 'authorized_users', 'videoCategory'));
    }

    public function update(UpdateVideoCategoryRequest $request, VideoCategory $videoCategory)
    {
        $videoCategory->update($request->all());
        $videoCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $videoCategory->photo || $request->input('photo') !== $videoCategory->photo->file_name) {
                if ($videoCategory->photo) {
                    $videoCategory->photo->delete();
                }
                $videoCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($videoCategory->photo) {
            $videoCategory->photo->delete();
        }

        return redirect()->route('admin.video-categories.index');
    }

    public function show(VideoCategory $videoCategory)
    {
        abort_if(Gate::denies('video_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoCategory->load('authorized_roles', 'authorized_users', 'subjectsVideoTutorials');

        return view('admin.videoCategories.show', compact('videoCategory'));
    }

    public function destroy(VideoCategory $videoCategory)
    {
        abort_if(Gate::denies('video_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyVideoCategoryRequest $request)
    {
        $videoCategories = VideoCategory::find(request('ids'));

        foreach ($videoCategories as $videoCategory) {
            $videoCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('video_category_create') && Gate::denies('video_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VideoCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
