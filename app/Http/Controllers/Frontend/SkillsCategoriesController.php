<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkillsCategoryRequest;
use App\Http\Requests\StoreSkillsCategoryRequest;
use App\Http\Requests\UpdateSkillsCategoryRequest;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SkillsCategoriesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('skills_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skillsCategories = SkillsCategory::with(['media'])->get();

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

        if ($request->input('photo', false)) {
            $skillsCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skillsCategory->id]);
        }

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('skills_category_create') && Gate::denies('skills_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SkillsCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
