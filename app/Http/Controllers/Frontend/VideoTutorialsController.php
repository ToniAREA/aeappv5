<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVideoTutorialRequest;
use App\Http\Requests\StoreVideoTutorialRequest;
use App\Http\Requests\UpdateVideoTutorialRequest;
use App\Models\VideoCategory;
use App\Models\VideoTutorial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VideoTutorialsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('video_tutorial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoTutorials = VideoTutorial::with(['subjects', 'media'])->get();

        return view('frontend.videoTutorials.index', compact('videoTutorials'));
    }

    public function create()
    {
        abort_if(Gate::denies('video_tutorial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = VideoCategory::pluck('subject', 'id');

        return view('frontend.videoTutorials.create', compact('subjects'));
    }

    public function store(StoreVideoTutorialRequest $request)
    {
        $videoTutorial = VideoTutorial::create($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        if ($request->input('image', false)) {
            $videoTutorial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $videoTutorial->id]);
        }

        return redirect()->route('frontend.video-tutorials.index');
    }

    public function edit(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = VideoCategory::pluck('subject', 'id');

        $videoTutorial->load('subjects');

        return view('frontend.videoTutorials.edit', compact('subjects', 'videoTutorial'));
    }

    public function update(UpdateVideoTutorialRequest $request, VideoTutorial $videoTutorial)
    {
        $videoTutorial->update($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        if ($request->input('image', false)) {
            if (! $videoTutorial->image || $request->input('image') !== $videoTutorial->image->file_name) {
                if ($videoTutorial->image) {
                    $videoTutorial->image->delete();
                }
                $videoTutorial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($videoTutorial->image) {
            $videoTutorial->image->delete();
        }

        return redirect()->route('frontend.video-tutorials.index');
    }

    public function show(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoTutorial->load('subjects');

        return view('frontend.videoTutorials.show', compact('videoTutorial'));
    }

    public function destroy(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoTutorial->delete();

        return back();
    }

    public function massDestroy(MassDestroyVideoTutorialRequest $request)
    {
        $videoTutorials = VideoTutorial::find(request('ids'));

        foreach ($videoTutorials as $videoTutorial) {
            $videoTutorial->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('video_tutorial_create') && Gate::denies('video_tutorial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VideoTutorial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
