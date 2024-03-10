<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;
use App\Http\Resources\Admin\ToDoResource;
use App\Models\ToDo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ToDoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('to_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ToDoResource(ToDo::with(['for_roles', 'for_employee'])->get());
    }

    public function store(StoreToDoRequest $request)
    {
        $toDo = ToDo::create($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));

        return (new ToDoResource($toDo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ToDoResource($toDo->load(['for_roles', 'for_employee']));
    }

    public function update(UpdateToDoRequest $request, ToDo $toDo)
    {
        $toDo->update($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));

        return (new ToDoResource($toDo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
