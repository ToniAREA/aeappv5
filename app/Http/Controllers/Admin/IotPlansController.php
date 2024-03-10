<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class IotPlansController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('iot_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IotPlan::query()->select(sprintf('%s.*', (new IotPlan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'iot_plan_show';
                $editGate      = 'iot_plan_edit';
                $deleteGate    = 'iot_plan_delete';
                $crudRoutePart = 'iot-plans';

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
            $table->editColumn('plan_name', function ($row) {
                return $row->plan_name ? $row->plan_name : '';
            });
            $table->editColumn('short_description', function ($row) {
                return $row->short_description ? $row->short_description : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('period', function ($row) {
                return $row->period ? IotPlan::PERIOD_RADIO[$row->period] : '';
            });
            $table->editColumn('period_price', function ($row) {
                return $row->period_price ? $row->period_price : '';
            });
            $table->editColumn('seo_title', function ($row) {
                return $row->seo_title ? $row->seo_title : '';
            });
            $table->editColumn('seo_meta_description', function ($row) {
                return $row->seo_meta_description ? $row->seo_meta_description : '';
            });
            $table->editColumn('seo_slug', function ($row) {
                return $row->seo_slug ? $row->seo_slug : '';
            });
            $table->editColumn('contract', function ($row) {
                return $row->contract ? '<a href="' . $row->contract->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'show_online', 'contract']);

            return $table->make(true);
        }

        return view('admin.iotPlans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('iot_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iotPlans.create');
    }

    public function store(StoreIotPlanRequest $request)
    {
        $iotPlan = IotPlan::create($request->all());

        if ($request->input('contract', false)) {
            $iotPlan->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract'))))->toMediaCollection('contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $iotPlan->id]);
        }

        return redirect()->route('admin.iot-plans.index');
    }

    public function edit(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.iotPlans.edit', compact('iotPlan'));
    }

    public function update(UpdateIotPlanRequest $request, IotPlan $iotPlan)
    {
        $iotPlan->update($request->all());

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

        return redirect()->route('admin.iot-plans.index');
    }

    public function show(IotPlan $iotPlan)
    {
        abort_if(Gate::denies('iot_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iotPlan->load('planIotSuscriptions');

        return view('admin.iotPlans.show', compact('iotPlan'));
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
