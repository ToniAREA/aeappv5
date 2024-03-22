<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\Admin\CommentResource;
use App\Models\Comment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommentResource(Comment::with(['wlist', 'from_user', 'to_users'])->get());
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());
        $comment->to_users()->sync($request->input('to_users', []));
        foreach ($request->input('photos', []) as $file) {
            $comment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        foreach ($request->input('files', []) as $file) {
            $comment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Comment $comment)
    {
        abort_if(Gate::denies('comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommentResource($comment->load(['wlist', 'from_user', 'to_users']));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        $comment->to_users()->sync($request->input('to_users', []));
        if (count($comment->photos) > 0) {
            foreach ($comment->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $comment->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $comment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        if (count($comment->files) > 0) {
            foreach ($comment->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $comment->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $comment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Comment $comment)
    {
        abort_if(Gate::denies('comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
