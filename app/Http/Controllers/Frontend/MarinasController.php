<?php

namespace App\Http\Controllers\Frontend;

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

class MarinasController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('marina_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::with(['contacts', 'contact_docs', 'media'])->get();

        return view('frontend.marinas.index', compact('marinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('marina_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $contact_docs = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.marinas.create', compact('contact_docs', 'contacts'));
    }

    public function store(StoreMarinaRequest $request)
    {
        $marina = Marina::create($request->all());
        $marina->contacts()->sync($request->input('contacts', []));
        if ($request->input('marina_photo', false)) {
            $marina->addMedia(storage_path('tmp/uploads/' . basename($request->input('marina_photo'))))->toMediaCollection('marina_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $marina->id]);
        }

        return redirect()->route('frontend.marinas.index');
    }

    public function edit(Marina $marina)
    {
        abort_if(Gate::denies('marina_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $contact_docs = ContactContact::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marina->load('contacts', 'contact_docs');

        return view('frontend.marinas.edit', compact('contact_docs', 'contacts', 'marina'));
    }

    public function update(UpdateMarinaRequest $request, Marina $marina)
    {
        $marina->update($request->all());
        $marina->contacts()->sync($request->input('contacts', []));
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

        return redirect()->route('frontend.marinas.index');
    }

    public function show(Marina $marina)
    {
        abort_if(Gate::denies('marina_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->load('contacts', 'contact_docs', 'marinaBoats', 'marinaWlogs');

        return view('frontend.marinas.show', compact('marina'));
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
