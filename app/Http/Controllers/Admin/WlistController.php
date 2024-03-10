<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWlistRequest;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Employee;
use App\Models\FinalcialDocument;
use App\Models\Role;
use App\Models\User;
use App\Models\Wlist;
use App\Models\WlistStatus;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WlistController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wlist::with(['client', 'boat', 'from_user', 'for_roles', 'for_employee', 'status', 'financial_document'])->select(sprintf('%s.*', (new Wlist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wlist_show';
                $editGate      = 'wlist_edit';
                $deleteGate    = 'wlist_delete';
                $crudRoutePart = 'wlists';

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
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->editColumn('order_type', function ($row) {
                return $row->order_type ? Wlist::ORDER_TYPE_RADIO[$row->order_type] : '';
            });
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('boat.boat_type', function ($row) {
                return $row->boat ? (is_string($row->boat) ? $row->boat : $row->boat->boat_type) : '';
            });
            $table->addColumn('from_user_name', function ($row) {
                return $row->from_user ? $row->from_user->name : '';
            });

            $table->editColumn('from_user.email', function ($row) {
                return $row->from_user ? (is_string($row->from_user) ? $row->from_user : $row->from_user->email) : '';
            });
            $table->editColumn('for_role', function ($row) {
                $labels = [];
                foreach ($row->for_roles as $for_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $for_role->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('for_employee_id_employee', function ($row) {
                return $row->for_employee ? $row->for_employee->id_employee : '';
            });

            $table->editColumn('for_employee.namecomplete', function ($row) {
                return $row->for_employee ? (is_string($row->for_employee) ? $row->for_employee : $row->for_employee->namecomplete) : '';
            });
            $table->editColumn('boat_namecomplete', function ($row) {
                return $row->boat_namecomplete ? $row->boat_namecomplete : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('estimated_hours', function ($row) {
                return $row->estimated_hours ? $row->estimated_hours : '';
            });
            $table->editColumn('photos', function ($row) {
                if (! $row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('priority', function ($row) {
                return $row->priority ? $row->priority : '';
            });
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->editColumn('proforma_link', function ($row) {
                return $row->proforma_link ? $row->proforma_link : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'boat', 'from_user', 'for_role', 'for_employee', 'photos', 'status', 'financial_document']);

            return $table->make(true);
        }

        $clients             = Client::get();
        $boats               = Boat::get();
        $users               = User::get();
        $roles               = Role::get();
        $employees           = Employee::get();
        $wlist_statuses      = WlistStatus::get();
        $finalcial_documents = FinalcialDocument::get();

        return view('admin.wlists.index', compact('clients', 'boats', 'users', 'roles', 'employees', 'wlist_statuses', 'finalcial_documents'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = WlistStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlists.create', compact('boats', 'clients', 'financial_documents', 'for_employees', 'for_roles', 'from_users', 'statuses'));
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        foreach ($request->input('photos', []) as $file) {
            $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $wlist->id]);
        }

        return redirect()->route('admin.wlists.index');
    }

    public function edit(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = WlistStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlist->load('client', 'boat', 'from_user', 'for_roles', 'for_employee', 'status', 'financial_document');

        return view('admin.wlists.edit', compact('boats', 'clients', 'financial_documents', 'for_employees', 'for_roles', 'from_users', 'statuses', 'wlist'));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        if (count($wlist->photos) > 0) {
            foreach ($wlist->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $wlist->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.wlists.index');
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->load('client', 'boat', 'from_user', 'for_roles', 'for_employee', 'status', 'financial_document', 'wlistWlogs', 'wlistComments', 'wlistMlogs', 'forWlistEmployeeRatings', 'wlistsAppointments');

        return view('admin.wlists.show', compact('wlist'));
    }

    public function destroy(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlistRequest $request)
    {
        $wlists = Wlist::find(request('ids'));

        foreach ($wlists as $wlist) {
            $wlist->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('wlist_create') && Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Wlist();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
