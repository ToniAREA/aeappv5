<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInsuranceRequest;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Models\ContactCompany;
use App\Models\ContactContact;
use App\Models\Insurance;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class InsurancesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('insurance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurances = Insurance::with(['company', 'contacts', 'media'])->get();

        return view('admin.insurances.index', compact('insurances'));
    }

    public function create()
    {
        abort_if(Gate::denies('insurance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        return view('admin.insurances.create', compact('companies', 'contacts'));
    }

    public function store(StoreInsuranceRequest $request)
    {
        $insurance = Insurance::create($request->all());
        $insurance->contacts()->sync($request->input('contacts', []));
        foreach ($request->input('files', []) as $file) {
            $insurance->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $insurance->id]);
        }

        return redirect()->route('admin.insurances.index');
    }

    public function edit(Insurance $insurance)
    {
        abort_if(Gate::denies('insurance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contacts = ContactContact::pluck('contact_first_name', 'id');

        $insurance->load('company', 'contacts');

        return view('admin.insurances.edit', compact('companies', 'contacts', 'insurance'));
    }

    public function update(UpdateInsuranceRequest $request, Insurance $insurance)
    {
        $insurance->update($request->all());
        $insurance->contacts()->sync($request->input('contacts', []));
        if (count($insurance->files) > 0) {
            foreach ($insurance->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $insurance->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $insurance->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.insurances.index');
    }

    public function show(Insurance $insurance)
    {
        abort_if(Gate::denies('insurance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance->load('company', 'contacts');

        return view('admin.insurances.show', compact('insurance'));
    }

    public function destroy(Insurance $insurance)
    {
        abort_if(Gate::denies('insurance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance->delete();

        return back();
    }

    public function massDestroy(MassDestroyInsuranceRequest $request)
    {
        $insurances = Insurance::find(request('ids'));

        foreach ($insurances as $insurance) {
            $insurance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('insurance_create') && Gate::denies('insurance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Insurance();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
