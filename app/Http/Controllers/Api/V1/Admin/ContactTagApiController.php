<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactTagRequest;
use App\Http\Requests\UpdateContactTagRequest;
use App\Http\Resources\Admin\ContactTagResource;
use App\Models\ContactTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactTagApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactTagResource(ContactTag::all());
    }

    public function store(StoreContactTagRequest $request)
    {
        $contactTag = ContactTag::create($request->all());

        return (new ContactTagResource($contactTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ContactTag $contactTag)
    {
        abort_if(Gate::denies('contact_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ContactTagResource($contactTag);
    }

    public function update(UpdateContactTagRequest $request, ContactTag $contactTag)
    {
        $contactTag->update($request->all());

        return (new ContactTagResource($contactTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ContactTag $contactTag)
    {
        abort_if(Gate::denies('contact_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
