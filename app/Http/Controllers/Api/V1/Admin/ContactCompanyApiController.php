<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreContactCompanyRequest;
use App\Http\Requests\UpdateContactCompanyRequest;
use App\Http\Resources\Admin\ContactCompanyResource;
use App\Models\ContactCompany;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactCompanyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('contact_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactCompanyResource(ContactCompany::with(['contacts'])->get());
    }

    public function store(StoreContactCompanyRequest $request)
    {
        $contactCompany = ContactCompany::create($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));
        if ($request->input('company_logo', false)) {
            $contactCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
        }

        return (new ContactCompanyResource($contactCompany))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactCompanyResource($contactCompany->load(['contacts']));
    }

    public function update(UpdateContactCompanyRequest $request, ContactCompany $contactCompany)
    {
        $contactCompany->update($request->all());
        $contactCompany->contacts()->sync($request->input('contacts', []));
        if ($request->input('company_logo', false)) {
            if (! $contactCompany->company_logo || $request->input('company_logo') !== $contactCompany->company_logo->file_name) {
                if ($contactCompany->company_logo) {
                    $contactCompany->company_logo->delete();
                }
                $contactCompany->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
            }
        } elseif ($contactCompany->company_logo) {
            $contactCompany->company_logo->delete();
        }

        return (new ContactCompanyResource($contactCompany))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactCompany $contactCompany)
    {
        abort_if(Gate::denies('contact_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactCompany->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
