<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySkillsCategoryRequest;
use App\Http\Requests\StoreSkillsCategoryRequest;
use App\Http\Requests\UpdateSkillsCategoryRequest;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillsCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('skills_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skillsCategories = SkillsCategory::all();

        return view('frontend.skillsCategories.index', compact('skillsCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('skills_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.skillsCategories.create');
    }

    public function store(StoreSkillsCategoryRequest $request)
    {
        $skillsCategory = SkillsCategory::create($request->all());

        return redirect()->route('frontend.skills-categories.index');
    }

    public function edit(SkillsCategory $skillsCategory)
    {
        abort_if(Gate::denies('skills_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.skillsCategories.edit', compact('skillsCategory'));
    }

    public function update(UpdateSkillsCategoryRequest $request, SkillsCategory $skillsCategory)
    {
        $skillsCategory->update($request->all());

        return redirect()->route('frontend.skills-categories.index');
    }

    public function show(SkillsCategory $skillsCategory)
    {
        abort_if(Gate::denies('skills_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skillsCategory->load('subjectEmployeeSkills');

        return view('frontend.skillsCategories.show', compact('skillsCategory'));
    }

    public function destroy(SkillsCategory $skillsCategory)
    {
        abort_if(Gate::denies('skills_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skillsCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySkillsCategoryRequest $request)
    {
        $skillsCategories = SkillsCategory::find(request('ids'));

        foreach ($skillsCategories as $skillsCategory) {
            $skillsCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
