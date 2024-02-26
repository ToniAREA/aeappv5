<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCarePlanRequest;
use App\Http\Requests\StoreCarePlanRequest;
use App\Http\Requests\UpdateCarePlanRequest;
use App\Models\CarePlan;
use App\Models\Checkpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarePlansController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('care_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CarePlan::with(['checkpoints'])->select(sprintf('%s.*', (new CarePlan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'care_plan_show';
                $editGate      = 'care_plan_edit';
                $deleteGate    = 'care_plan_delete';
                $crudRoutePart = 'care-plans';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('short_description', function ($row) {
                return $row->short_description ? $row->short_description : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('checkpoints', function ($row) {
                $labels = [];
                foreach ($row->checkpoints as $checkpoint) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $checkpoint->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('period', function ($row) {
                return $row->period ? CarePlan::PERIOD_RADIO[$row->period] : '';
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

            $table->rawColumns(['actions', 'placeholder', 'checkpoints']);

            return $table->make(true);
        }

        return view('admin.carePlans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('care_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoints = Checkpoint::pluck('name', 'id');

        return view('admin.carePlans.create', compact('checkpoints'));
    }

    public function store(StoreCarePlanRequest $request)
    {
        $carePlan = CarePlan::create($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));

        return redirect()->route('admin.care-plans.index');
    }

    public function edit(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoints = Checkpoint::pluck('name', 'id');

        $carePlan->load('checkpoints');

        return view('admin.carePlans.edit', compact('carePlan', 'checkpoints'));
    }

    public function update(UpdateCarePlanRequest $request, CarePlan $carePlan)
    {
        $carePlan->update($request->all());
        $carePlan->checkpoints()->sync($request->input('checkpoints', []));

        return redirect()->route('admin.care-plans.index');
    }

    public function show(CarePlan $carePlan)
    {
        abort_if(Gate::denies('care_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carePlan->load('checkpoints', 'carePlanMaintenanceSuscriptions');

        return view('admin.carePlans.show', compact('carePlan'));
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
}
