<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuscriptionRequest;
use App\Http\Requests\StoreSuscriptionRequest;
use App\Http\Requests\UpdateSuscriptionRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\FinalcialDocument;
use App\Models\Plan;
use App\Models\Suscription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuscriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('suscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Suscription::with(['user', 'client', 'boats', 'plan', 'financial_document'])->select(sprintf('%s.*', (new Suscription)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'suscription_show';
                $editGate      = 'suscription_edit';
                $deleteGate    = 'suscription_delete';
                $crudRoutePart = 'suscriptions';

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
            $table->addColumn('plan_plan_name', function ($row) {
                return $row->plan ? $row->plan->plan_name : '';
            });

            $table->editColumn('signed_contract', function ($row) {
                return $row->signed_contract ? '<a href="' . $row->signed_contract->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
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

            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'is_active', 'client', 'boats', 'plan', 'signed_contract', 'financial_document']);

            return $table->make(true);
        }

        return view('admin.suscriptions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('suscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.suscriptions.create', compact('boats', 'clients', 'financial_documents', 'plans', 'users'));
    }

    public function store(StoreSuscriptionRequest $request)
    {
        $suscription = Suscription::create($request->all());
        $suscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suscription->id]);
        }

        return redirect()->route('admin.suscriptions.index');
    }

    public function edit(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id');

        $plans = Plan::pluck('plan_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suscription->load('user', 'client', 'boats', 'plan', 'financial_document');

        return view('admin.suscriptions.edit', compact('boats', 'clients', 'financial_documents', 'plans', 'suscription', 'users'));
    }

    public function update(UpdateSuscriptionRequest $request, Suscription $suscription)
    {
        $suscription->update($request->all());
        $suscription->boats()->sync($request->input('boats', []));
        if ($request->input('signed_contract', false)) {
            if (! $suscription->signed_contract || $request->input('signed_contract') !== $suscription->signed_contract->file_name) {
                if ($suscription->signed_contract) {
                    $suscription->signed_contract->delete();
                }
                $suscription->addMedia(storage_path('tmp/uploads/' . basename($request->input('signed_contract'))))->toMediaCollection('signed_contract');
            }
        } elseif ($suscription->signed_contract) {
            $suscription->signed_contract->delete();
        }

        return redirect()->route('admin.suscriptions.index');
    }

    public function show(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscription->load('user', 'client', 'boats', 'plan', 'financial_document');

        return view('admin.suscriptions.show', compact('suscription'));
    }

    public function destroy(Suscription $suscription)
    {
        abort_if(Gate::denies('suscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suscription->delete();

        return back();
    }

    public function massDestroy(MassDestroySuscriptionRequest $request)
    {
        $suscriptions = Suscription::find(request('ids'));

        foreach ($suscriptions as $suscription) {
            $suscription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('suscription_create') && Gate::denies('suscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Suscription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
