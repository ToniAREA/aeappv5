<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Http\Resources\Admin\InsuranceResource;
use App\Models\Insurance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsurancesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('insurance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceResource(Insurance::with(['company', 'contacts'])->get());
    }

    public function store(StoreInsuranceRequest $request)
    {
        $insurance = Insurance::create($request->all());
        $insurance->contacts()->sync($request->input('contacts', []));
        foreach ($request->input('files', []) as $file) {
            $insurance->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        return (new InsuranceResource($insurance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Insurance $insurance)
    {
        abort_if(Gate::denies('insurance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InsuranceResource($insurance->load(['company', 'contacts']));
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

        return (new InsuranceResource($insurance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Insurance $insurance)
    {
        abort_if(Gate::denies('insurance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $insurance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
