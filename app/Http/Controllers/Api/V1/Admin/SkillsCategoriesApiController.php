<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillsCategoryRequest;
use App\Http\Requests\UpdateSkillsCategoryRequest;
use App\Http\Resources\Admin\SkillsCategoryResource;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillsCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('skills_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkillsCategoryResource(SkillsCategory::all());
    }

    public function store(StoreSkillsCategoryRequest $request)
    {
        $skillsCategory = SkillsCategory::create($request->all());

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
