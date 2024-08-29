<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIotPlanRequest;
use App\Http\Requests\StoreIotPlanRequest;
use App\Http\Requests\UpdateIotPlanRequest;
use App\Models\IotPlan;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class IotPlansController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('iot_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotPlans = IotPlan::with(['media'])->get();

        return view('frontend.iotPlans.index', compact('iotPlans'));
    }

    public function create()
    {
        abort_if(Gate::denies('iot_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.iotPlans.create');
    }

    public function store(StoreIotPlanRequest $request)
    {
        $iotPlan = IotPlan::create($request->all());

        if ($request->input('photo', false)) {
            $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('contract', false)) {
            $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $iotPlan->id]);
        }

        return redirect()->route('frontend.iot-plans.index');
    }

    public function edit(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.iotPlans.edit', compact('iotPlan'));
    }

    public function update(UpdateIotPlanRequest $request, IotPlan $iotPlan)
    {
        $iotPlan->update($request->all());

        if ($request->input('photo', false)) {
            if (! $iotPlan->photo || $request->input('photo') !== $iotPlan->photo->file_name) {
                if ($iotPlan->photo) {
                    $iotPlan->photo->delete();
                }
                $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($iotPlan->photo) {
            $iotPlan->photo->delete();
        }

        if ($request->input('contract', false)) {
            if (! $iotPlan->contract || $request->input('contract') !== $iotPlan->contract->file_name) {
                if ($iotPlan->contract) {
                    $iotPlan->contract->delete();
                }
                $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
            }
        } elseif ($iotPlan->contract) {
            $iotPlan->contract->delete();
        }

        return redirect()->route('frontend.iot-plans.index');
    }

    public function show(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotPlan->load('planIotSuscriptions');

        return view('frontend.iotPlans.show', compact('iotPlan'));
    }

    public function destroy(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotPlan->delete();

        return back();
    }

    public function massDestroy(MassDestroyIotPlanRequest $request)
    {
        $iotPlans = IotPlan::find(request('ids'));

        foreach ($iotPlans as $iotPlan) {
            $iotPlan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('iot_plan_create') && Gate::denies('iot_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new IotPlan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
