<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFaqQuestionRequest;
use App\Http\Requests\UpdateFaqQuestionRequest;
use App\Http\Resources\Admin\FaqQuestionResource;
use App\Models\FaqQuestion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqQuestionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('faq_question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FaqQuestionResource(FaqQuestion::with(['category', 'authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreFaqQuestionRequest $request)
    {
        $faqQuestion = FaqQuestion::create($request->all());
        $faqQuestion->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqQuestion->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $faqQuestion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('files', []) as $file) {
            $faqQuestion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return (new FaqQuestionResource($faqQuestion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FaqQuestionResource($faqQuestion->load(['category', 'authorized_roles', 'authorized_users']));
    }

    public function update(UpdateFaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->update($request->all());
        $faqQuestion->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqQuestion->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $faqQuestion->photo || $request->input('photo') !== $faqQuestion->photo->file_name) {
                if ($faqQuestion->photo) {
                    $faqQuestion->photo->delete();
                }
                $faqQuestion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($faqQuestion->photo) {
            $faqQuestion->photo->delete();
        }

        if (count($faqQuestion->files) > 0) {
            foreach ($faqQuestion->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $faqQuestion->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $faqQuestion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return (new FaqQuestionResource($faqQuestion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        abort_if(Gate::denies('faq_question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqQuestion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
