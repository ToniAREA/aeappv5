<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFaqCategoryRequest;
use App\Http\Requests\UpdateFaqCategoryRequest;
use App\Http\Resources\Admin\FaqCategoryResource;
use App\Models\FaqCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('faq_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FaqCategoryResource(FaqCategory::with(['authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreFaqCategoryRequest $request)
    {
        $faqCategory = FaqCategory::create($request->all());
        $faqCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new FaqCategoryResource($faqCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FaqCategoryResource($faqCategory->load(['authorized_roles', 'authorized_users']));
    }

    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        $faqCategory->update($request->all());
        $faqCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $faqCategory->photo || $request->input('photo') !== $faqCategory->photo->file_name) {
                if ($faqCategory->photo) {
                    $faqCategory->photo->delete();
                }
                $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($faqCategory->photo) {
            $faqCategory->photo->delete();
        }

        return (new FaqCategoryResource($faqCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
