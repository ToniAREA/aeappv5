<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTechnicalDocumentationRequest;
use App\Http\Requests\UpdateTechnicalDocumentationRequest;
use App\Http\Resources\Admin\TechnicalDocumentationResource;
use App\Models\TechnicalDocumentation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TechnicalDocumentationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('technical_documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechnicalDocumentationResource(TechnicalDocumentation::with(['doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users'])->get());
    }

    public function store(StoreTechnicalDocumentationRequest $request)
    {
        $technicalDocumentation = TechnicalDocumentation::create($request->all());
        $technicalDocumentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $technicalDocumentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($request->input('image', false)) {
            $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new TechnicalDocumentationResource($technicalDocumentation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TechnicalDocumentationResource($technicalDocumentation->load(['doc_type', 'brand', 'product', 'authorized_roles', 'authorized_users']));
    }

    public function update(UpdateTechnicalDocumentationRequest $request, TechnicalDocumentation $technicalDocumentation)
    {
        $technicalDocumentation->update($request->all());
        $technicalDocumentation->authorized_roles()->sync($request->input('authorized_roles', []));
        $technicalDocumentation->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('file', false)) {
            if (! $technicalDocumentation->file || $request->input('file') !== $technicalDocumentation->file->file_name) {
                if ($technicalDocumentation->file) {
                    $technicalDocumentation->file->delete();
                }
                $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($technicalDocumentation->file) {
            $technicalDocumentation->file->delete();
        }

        if ($request->input('image', false)) {
            if (! $technicalDocumentation->image || $request->input('image') !== $technicalDocumentation->image->file_name) {
                if ($technicalDocumentation->image) {
                    $technicalDocumentation->image->delete();
                }
                $technicalDocumentation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($technicalDocumentation->image) {
            $technicalDocumentation->image->delete();
        }

        return (new TechnicalDocumentationResource($technicalDocumentation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TechnicalDocumentation $technicalDocumentation)
    {
        abort_if(Gate::denies('technical_documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicalDocumentation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
