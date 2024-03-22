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
use Yajra\DataTables\Facades\DataTables;

class BoatsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Boat::with(['marina', 'clients'])->select(sprintf('%s.*', (new Boat)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'boat_show';
                $editGate      = 'boat_edit';
                $deleteGate    = 'boat_delete';
                $crudRoutePart = 'boats';

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
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : '';
            });
            $table->editColumn('boat_type', function ($row) {
                return $row->boat_type ? $row->boat_type : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('boat_photo', function ($row) {
                if ($photo = $row->boat_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('imo', function ($row) {
                return $row->imo ? $row->imo : '';
            });
            $table->editColumn('mmsi', function ($row) {
                return $row->mmsi ? $row->mmsi : '';
            });
            $table->addColumn('marina_name', function ($row) {
                return $row->marina ? $row->marina->name : '';
            });

            $table->editColumn('sat_phone', function ($row) {
                return $row->sat_phone ? $row->sat_phone : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('clients', function ($row) {
                $labels = [];
                foreach ($row->clients as $client) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $client->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });

            $table->editColumn('settings_data', function ($row) {
                return $row->settings_data ? $row->settings_data : '';
            });
            $table->editColumn('public_ip', function ($row) {
                return $row->public_ip ? $row->public_ip : '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'boat_photo', 'marina', 'clients']);

            return $table->make(true);
        }

        $marinas = Marina::get();
        $clients = Client::get();

        return view('admin.boats.index', compact('marinas', 'clients'));
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
