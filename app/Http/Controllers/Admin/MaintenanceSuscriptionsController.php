<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaintenanceSuscriptionRequest;
use App\Http\Requests\StoreMaintenanceSuscriptionRequest;
use App\Http\Requests\UpdateMaintenanceSuscriptionRequest;
use App\Models\Boat;
use App\Models\CarePlan;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\MaintenanceSuscription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceSuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('maintenance_suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaintenanceSuscription::with(['user', 'financial_document', 'client', 'boats', 'care_plan'])->select(sprintf('%s.*', (new MaintenanceSuscription)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'maintenance_suscription_show';
                $editGate      = 'maintenance_suscription_edit';
                $deleteGate    = 'maintenance_suscription_delete';
                $crudRoutePart = 'maintenance-suscriptions';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('care_plan_name', function ($row) {
                return $row->care_plan ? $row->care_plan->name : '';
            });

            $table->editColumn('care_plan.period', function ($row) {
                return $row->care_plan ? (is_string($row->care_plan) ? $row->care_plan : $row->care_plan->period) : '';
            });
            $table->editColumn('signed_contract', function ($row) {
                return $row->signed_contract ? '<a href="' . $row->signed_contract->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->editColumn('hourly_rate_discount', function ($row) {
                return $row->hourly_rate_discount ? $row->hourly_rate_discount : '';
            });
            $table->editColumn('material_discount', function ($row) {
                return $row->material_discount ? $row->material_discount : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'financial_document', 'is_active', 'client', 'boats', 'care_plan', 'signed_contract']);

            return $table->make(true);
        }

        return view('admin.maintenanceSuscriptions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('maintenance_suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $care_plans = CarePlan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.maintenanceSuscriptions.create', compact('boats', 'care_plans', 'clients', 'financial_documents', 'users'));
    }

    public function store(StoreMaintenanceSuscriptionRequest $request)
    {
        $maintenanceSuscription = MaintenanceSuscription::create($request->all());
        $maintenanceSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $maintenanceSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $maintenanceSuscription->id]);
        }

        return redirect()->route('admin.maintenance-suscriptions.index');
    }

    public function edit(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $care_plans = CarePlan::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintenanceSuscription->load('user', 'financial_document', 'client', 'boats', 'care_plan');

        return view('admin.maintenanceSuscriptions.edit', compact('boats', 'care_plans', 'clients', 'financial_documents', 'maintenanceSuscription', 'users'));
    }

    public function update(UpdateMaintenanceSuscriptionRequest $request, MaintenanceSuscription $maintenanceSuscription)
    {
        $maintenanceSuscription->update($request->all());
        $maintenanceSuscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            if (! $maintenanceSuscription->signed_contract || $request->input('signed_contract') !== $maintenanceSuscription->signed_contract->file_name) {
                if ($maintenanceSuscription->signed_contract) {
                    $maintenanceSuscription->signed_contract->delete();
                }
                $maintenanceSuscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
            }
        } elseif ($maintenanceSuscription->signed_contract) {
            $maintenanceSuscription->signed_contract->delete();
        }

        return redirect()->route('admin.maintenance-suscriptions.index');
    }

    public function show(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscription->load('user', 'financial_document', 'client', 'boats', 'care_plan');

        return view('admin.maintenanceSuscriptions.show', compact('maintenanceSuscription'));
    }

    public function destroy(MaintenanceSuscription $maintenanceSuscription)
    {
        abort_if(Gate::denies('maintenance_suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintenanceSuscription->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintenanceSuscriptionRequest $request)
    {
        $maintenanceSuscriptions = MaintenanceSuscription::find(request('ids'));

        foreach ($maintenanceSuscriptions as $maintenanceSuscription) {
            $maintenanceSuscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('maintenance_suscription_create') && Gate::denies('maintenance_suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MaintenanceSuscription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
