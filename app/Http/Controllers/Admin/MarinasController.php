<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMarinaRequest;
use App\Http\Requests\StoreMarinaRequest;
use App\Http\Requests\UpdateMarinaRequest;
use App\Models\ContactContact;
use App\Models\Marina;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MarinasController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('marina_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Marina::with(['contact_docs'])->select(sprintf('%s.*', (new Marina)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'marina_show';
                $editGate      = 'marina_edit';
                $deleteGate    = 'marina_delete';
                $crudRoutePart = 'marinas';

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
            $table->editColumn('marina_photo', function ($row) {
                if ($photo = $row->marina_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
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
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->addColumn('contact_docs_contact_first_name', function ($row) {
                return $row->contact_docs ? $row->contact_docs->contact_first_name : '';
            });

            $table->editColumn('contact_docs.contact_email', function ($row) {
                return $row->contact_docs ? (is_string($row->contact_docs) ? $row->contact_docs : $row->contact_docs->contact_email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'marina_photo', 'contact_docs']);

            return $table->make(true);
        }

        return view('admin.marinas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('marina_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_docs = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.marinas.create', compact('contact_docs'));
    }

    public function store(StoreMarinaRequest $request)
    {
        $marina = Marina::create($request->all());

        if ($request->input('marina_photo', false)) {
            $marina->addMedia(storage_path('tmp/uploads/' . basename($request->input('marina_photo'))))->toMediaCollection('marina_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $marina->id]);
        }

        return redirect()->route('admin.marinas.index');
    }

    public function edit(Marina $marina)
    {
        abort_if(Gate::denies('marina_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact_docs = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marina->load('contact_docs');

        return view('admin.marinas.edit', compact('contact_docs', 'marina'));
    }

    public function update(UpdateMarinaRequest $request, Marina $marina)
    {
        $marina->update($request->all());

        if ($request->input('marina_photo', false)) {
            if (! $marina->marina_photo || $request->input('marina_photo') !== $marina->marina_photo->file_name) {
                if ($marina->marina_photo) {
                    $marina->marina_photo->delete();
                }
                $marina->addMedia(storage_path('tmp/uploads/' . basename($request->input('marina_photo'))))->toMediaCollection('marina_photo');
            }
        } elseif ($marina->marina_photo) {
            $marina->marina_photo->delete();
        }

        return redirect()->route('admin.marinas.index');
    }

    public function show(Marina $marina)
    {
        abort_if(Gate::denies('marina_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->load('contact_docs', 'marinaBoats', 'marinaWlogs');

        return view('admin.marinas.show', compact('marina'));
    }

    public function destroy(Marina $marina)
    {
        abort_if(Gate::denies('marina_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarinaRequest $request)
    {
        $marinas = Marina::find(request('ids'));

        foreach ($marinas as $marina) {
            $marina->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('marina_create') && Gate::denies('marina_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Marina();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
