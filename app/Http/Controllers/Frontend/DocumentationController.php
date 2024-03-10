<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentationRequest;
use App\Http\Requests\StoreDocumentationRequest;
use App\Http\Requests\UpdateDocumentationRequest;
use App\Models\Documentation;
use App\Models\DocumentationCategory;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DocumentationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentations = Documentation::with(['category', 'authorized_roles', 'authorized_users', 'media'])->get();

        return view('frontend.documentations.index', compact('documentations'));
    }

    public function create()
    {
        abort_if(Gate::denies('documentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = DocumentationCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('frontend.documentations.create', compact('authorized_roles', 'authorized_users', 'categories'));
    }

    public function store(StoreDocumentationRequest $request)
    {
        $documentation = Documentation::create($request->all());
        $documentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            $documentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $documentation->id]);
        }

        return redirect()->route('frontend.documentations.index');
    }

    public function edit(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = DocumentationCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $documentation->load('category', 'authorized_roles', 'authorized_users');

        return view('frontend.documentations.edit', compact('authorized_roles', 'authorized_users', 'categories', 'documentation'));
    }

    public function update(UpdateDocumentationRequest $request, Documentation $documentation)
    {
        $documentation->update($request->all());
        $documentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            if (! $documentation->file || $request->input('file') !== $documentation->file->file_name) {
                if ($documentation->file) {
                    $documentation->file->delete();
                }
                $documentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($documentation->file) {
            $documentation->file->delete();
        }

        return redirect()->route('frontend.documentations.index');
    }

    public function show(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentation->load('category', 'authorized_roles', 'authorized_users');

        return view('frontend.documentations.show', compact('documentation'));
    }

    public function destroy(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentationRequest $request)
    {
        $documentations = Documentation::find(request('ids'));

        foreach ($documentations as $documentation) {
            $documentation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('documentation_create') && Gate::denies('documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Documentation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
