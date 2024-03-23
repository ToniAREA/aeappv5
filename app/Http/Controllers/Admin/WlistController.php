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

class WlistController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::with(['client', 'boat', 'from_user', 'for_roles', 'for_employee', 'status', 'financial_document', 'media'])->get();

        $clients = Client::get();

        $boats = Boat::get();

        $users = User::get();

        $roles = Role::get();

        $employees = Employee::get();

        $wlist_statuses = WlistStatus::get();

        $finalcial_documents = FinalcialDocument::get();

        return view('admin.wlists.index', compact('boats', 'clients', 'employees', 'finalcial_documents', 'roles', 'users', 'wlist_statuses', 'wlists'));
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
