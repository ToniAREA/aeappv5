<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CommentsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comment::with(['wlist', 'from_user'])->select(sprintf('%s.*', (new Comment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'comment_show';
                $editGate      = 'comment_edit';
                $deleteGate    = 'comment_delete';
                $crudRoutePart = 'comments';

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
            $table->addColumn('wlist_boat_namecomplete', function ($row) {
                return $row->wlist ? $row->wlist->boat_namecomplete : '';
            });

            $table->editColumn('wlist.description', function ($row) {
                return $row->wlist ? (is_string($row->wlist) ? $row->wlist : $row->wlist->description) : '';
            });
            $table->addColumn('from_user_name', function ($row) {
                return $row->from_user ? $row->from_user->name : '';
            });

            $table->editColumn('from_user.email', function ($row) {
                return $row->from_user ? (is_string($row->from_user) ? $row->from_user : $row->from_user->email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'wlist', 'from_user']);

            return $table->make(true);
        }

        $wlists = Wlist::get();
        $users  = User::get();

        return view('admin.comments.index', compact('wlists', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.comments.create', compact('from_users', 'wlists'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comment->id]);
        }

        return redirect()->route('admin.comments.index');
    }

    public function edit(Comment $comment)
    {
        abort_if(Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comment->load('wlist', 'from_user');

        return view('admin.comments.edit', compact('comment', 'from_users', 'wlists'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return redirect()->route('admin.comments.index');
    }

    public function show(Comment $comment)
    {
        abort_if(Gate::denies('comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->load('wlist', 'from_user');

        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        abort_if(Gate::denies('comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommentRequest $request)
    {
        $comments = Comment::find(request('ids'));

        foreach ($comments as $comment) {
            $comment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('comment_create') && Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Comment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
