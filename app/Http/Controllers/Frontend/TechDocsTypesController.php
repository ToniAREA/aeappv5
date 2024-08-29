<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTechDocsTypeRequest;
use App\Http\Requests\StoreTechDocsTypeRequest;
use App\Http\Requests\UpdateTechDocsTypeRequest;
use App\Models\Role;
use App\Models\TechDocsType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TechDocsTypesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tech_docs_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsTypes = TechDocsType::with(['authorized_roles', 'authorized_users', 'media'])->get();

        return view('frontend.techDocsTypes.index', compact('techDocsTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('tech_docs_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('frontend.techDocsTypes.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreTechDocsTypeRequest $request)
    {
        $techDocsType = TechDocsType::create($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $techDocsType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $techDocsType->id]);
        }

        return redirect()->route('frontend.tech-docs-types.index');
    }

    public function edit(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $techDocsType->load('authorized_roles', 'authorized_users');

        return view('frontend.techDocsTypes.edit', compact('authorized_roles', 'authorized_users', 'techDocsType'));
    }

    public function update(UpdateTechDocsTypeRequest $request, TechDocsType $techDocsType)
    {
        $techDocsType->update($request->all());
        $techDocsType->authorized_roles()->sync($request->input('authorized_roles', []));
        $techDocsType->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $techDocsType->photo || $request->input('photo') !== $techDocsType->photo->file_name) {
                if ($techDocsType->photo) {
                    $techDocsType->photo->delete();
                }
                $techDocsType->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($techDocsType->photo) {
            $techDocsType->photo->delete();
        }

        return redirect()->route('frontend.tech-docs-types.index');
    }

    public function show(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->load('authorized_roles', 'authorized_users', 'docTypeTechnicalDocumentations');

        return view('frontend.techDocsTypes.show', compact('techDocsType'));
    }

    public function destroy(TechDocsType $techDocsType)
    {
        abort_if(Gate::denies('tech_docs_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $techDocsType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechDocsTypeRequest $request)
    {
        $techDocsTypes = TechDocsType::find(request('ids'));

        foreach ($techDocsTypes as $techDocsType) {
            $techDocsType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tech_docs_type_create') && Gate::denies('tech_docs_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TechDocsType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
