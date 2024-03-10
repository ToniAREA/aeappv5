<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVideoTutorialRequest;
use App\Http\Requests\StoreVideoTutorialRequest;
use App\Http\Requests\UpdateVideoTutorialRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\VideoCategory;
use App\Models\VideoTutorial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VideoTutorialsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('video_tutorial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VideoTutorial::with(['subjects', 'authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new VideoTutorial)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'video_tutorial_show';
                $editGate      = 'video_tutorial_edit';
                $deleteGate    = 'video_tutorial_delete';
                $crudRoutePart = 'video-tutorials';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('video_url', function ($row) {
                return $row->video_url ? $row->video_url : '';
            });
            $table->editColumn('subjects', function ($row) {
                $labels = [];
                foreach ($row->subjects as $subject) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $subject->subject);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('seo_title', function ($row) {
                return $row->seo_title ? $row->seo_title : '';
            });
            $table->editColumn('seo_meta_description', function ($row) {
                return $row->seo_meta_description ? $row->seo_meta_description : '';
            });
            $table->editColumn('seo_slug', function ($row) {
                return $row->seo_slug ? $row->seo_slug : '';
            });
            $table->editColumn('authorized_roles', function ($row) {
                $labels = [];
                foreach ($row->authorized_roles as $authorized_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('authorized_users', function ($row) {
                $labels = [];
                foreach ($row->authorized_users as $authorized_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_user->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'show_online', 'image', 'subjects', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        return view('admin.videoTutorials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('video_tutorial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = VideoCategory::pluck('subject', 'id');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.videoTutorials.create', compact('authorized_roles', 'authorized_users', 'subjects'));
    }

    public function store(StoreVideoTutorialRequest $request)
    {
        $videoTutorial = VideoTutorial::create($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        $videoTutorial->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoTutorial->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('image', false)) {
            $videoTutorial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $videoTutorial->id]);
        }

        return redirect()->route('admin.video-tutorials.index');
    }

    public function edit(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = VideoCategory::pluck('subject', 'id');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $videoTutorial->load('subjects', 'authorized_roles', 'authorized_users');

        return view('admin.videoTutorials.edit', compact('authorized_roles', 'authorized_users', 'subjects', 'videoTutorial'));
    }

    public function update(UpdateVideoTutorialRequest $request, VideoTutorial $videoTutorial)
    {
        $videoTutorial->update($request->all());
        $videoTutorial->subjects()->sync($request->input('subjects', []));
        $videoTutorial->authorized_roles()->sync($request->input('authorized_roles', []));
        $videoTutorial->authorized_users()->sync($request->input('authorized_users', []));
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

        return redirect()->route('admin.video-tutorials.index');
    }

    public function show(VideoTutorial $videoTutorial)
    {
        abort_if(Gate::denies('video_tutorial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videoTutorial->load('subjects', 'authorized_roles', 'authorized_users');

        return view('admin.videoTutorials.show', compact('videoTutorial'));
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
