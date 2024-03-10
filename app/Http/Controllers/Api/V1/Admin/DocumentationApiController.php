<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocumentationRequest;
use App\Http\Requests\UpdateDocumentationRequest;
use App\Http\Resources\Admin\DocumentationResource;
use App\Models\Documentation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentationResource(Documentation::with(['category', 'authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreDocumentationRequest $request)
    {
        $documentation = Documentation::create($request->all());
        $documentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $documentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            $documentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new DocumentationResource($documentation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentationResource($documentation->load(['category', 'authorized_roles', 'authorized_users']));
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

        return (new DocumentationResource($documentation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
