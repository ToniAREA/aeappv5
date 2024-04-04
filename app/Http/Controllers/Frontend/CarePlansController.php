<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCarePlanRequest;
use App\Http\Requests\StoreCarePlanRequest;
use App\Http\Requests\UpdateCarePlanRequest;
use App\Models\CarePlan;
use App\Models\Checkpoint;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CarePlansController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('care_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carePlans = CarePlan::with(['checkpoints', 'media'])->get();

        return view('frontend.carePlans.index', compact('carePlans'));
    }

    public function create()
    {
        abort_if(Gate::denies('care_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoints = Checkpoint::pluck('name', 'id');

        return view('frontend.carePlans.create', compact('checkpoints'));
    }

    public function store(StoreCarePlanRequest $request)
    {
        $carePlan = CarePlan::create($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));
        if ($request->input('photo', false)) {
            $carePlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $carePlan->id]);
        }

        return redirect()->route('frontend.care-plans.index');
    }

    public function edit(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoints = Checkpoint::pluck('name', 'id');

        $carePlan->load('checkpoints');

        return view('frontend.carePlans.edit', compact('carePlan', 'checkpoints'));
    }

    public function update(UpdateCarePlanRequest $request, CarePlan $carePlan)
    {
        $carePlan->update($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));
        if ($request->input('photo', false)) {
            if (! $carePlan->photo || $request->input('photo') !== $carePlan->photo->file_name) {
                if ($carePlan->photo) {
                    $carePlan->photo->delete();
                }
                $carePlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($carePlan->photo) {
            $carePlan->photo->delete();
        }

        return redirect()->route('frontend.care-plans.index');
    }

    public function show(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carePlan->load('checkpoints', 'carePlanMaintenanceSuscriptions');

        return view('frontend.carePlans.show', compact('carePlan'));
    }

    public function destroy(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carePlan->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarePlanRequest $request)
    {
        $carePlans = CarePlan::find(request('ids'));

        foreach ($carePlans as $carePlan) {
            $carePlan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('care_plan_create') && Gate::denies('care_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CarePlan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
