<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSkillsCategoryRequest;
use App\Http\Requests\UpdateSkillsCategoryRequest;
use App\Http\Resources\Admin\SkillsCategoryResource;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillsCategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('skills_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkillsCategoryResource(SkillsCategory::all());
    }

    public function store(StoreSkillsCategoryRequest $request)
    {
        $skillsCategory = SkillsCategory::create($request->all());

        if ($request->input('photo', false)) {
            $skillsCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new SkillsCategoryResource($skillsCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SkillsCategory $skillsCategory)
    {
        abort_if(Gate::denies('skills_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkillsCategoryResource($skillsCategory);
    }

    public function update(UpdateSkillsCategoryRequest $request, SkillsCategory $skillsCategory)
    {
        $skillsCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (! $skillsCategory->photo || $request->input('photo') !== $skillsCategory->photo->file_name) {
                if ($skillsCategory->photo) {
                    $skillsCategory->photo->delete();
                }
                $skillsCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($skillsCategory->photo) {
            $skillsCategory->photo->delete();
        }

        return (new SkillsCategoryResource($skillsCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SkillsCategory $skillsCategory)
    {
        abort_if(Gate::denies('skills_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skillsCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
