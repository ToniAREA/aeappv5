<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBoatRequest;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Marina;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BoatsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::with(['marina', 'clients', 'media'])->get();

        $marinas = Marina::get();

        $clients = Client::get();

        return view('admin.boats.index', compact('boats', 'clients', 'marinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        return view('admin.boats.create', compact('clients', 'marinas'));
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());
        $boat->clients()->sync($request->input('clients', []));
        if ($request->input('boat_photo', false)) {
            $boat->addMedia(storage_path('tmp/uploads/' . basename($request->input('boat_photo'))))->toMediaCollection('boat_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $boat->id]);
        }

        return redirect()->route('admin.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        $boat->load('marina', 'clients');

        return view('admin.boats.edit', compact('boat', 'clients', 'marinas'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());
        $boat->clients()->sync($request->input('clients', []));
        if ($request->input('boat_photo', false)) {
            if (! $boat->boat_photo || $request->input('boat_photo') !== $boat->boat_photo->file_name) {
                if ($boat->boat_photo) {
                    $boat->boat_photo->delete();
                }
                $boat->addMedia(storage_path('tmp/uploads/' . basename($request->input('boat_photo'))))->toMediaCollection('boat_photo');
            }
        } elseif ($boat->boat_photo) {
            $boat->boat_photo->delete();
        }

        return redirect()->route('admin.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('marina', 'clients', 'boatWlists', 'boatAppointments', 'boatBookingLists', 'boatMlogs', 'boatAssetsRentals', 'boatsClients', 'boatsClientsReviews', 'boatsSuscriptions', 'boatsMaintenanceSuscriptions', 'boatsIotSuscriptions', 'boatsWaitingLists');

        return view('admin.boats.show', compact('boat'));
    }

    public function destroy(Boat $boat)
    {
        abort_if(Gate::denies('boat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoatRequest $request)
    {
        $boats = Boat::find(request('ids'));

        foreach ($boats as $boat) {
            $boat->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('boat_create') && Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Boat();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
