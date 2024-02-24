<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyToDoRequest;
use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\ToDo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ToDoController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('to_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToDo::with(['for_roles', 'for_employee'])->select(sprintf('%s.*', (new ToDo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'to_do_show';
                $editGate      = 'to_do_edit';
                $deleteGate    = 'to_do_delete';
                $crudRoutePart = 'to-dos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('task', function ($row) {
                return $row->task ? $row->task : '';
            });
            $table->editColumn('for_role', function ($row) {
                $labels = [];
                foreach ($row->for_roles as $for_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $for_role->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('for_employee_id_employee', function ($row) {
                return $row->for_employee ? $row->for_employee->id_employee : '';
            });

            $table->editColumn('for_employee.namecomplete', function ($row) {
                return $row->for_employee ? (is_string($row->for_employee) ? $row->for_employee : $row->for_employee->namecomplete) : '';
            });

            $table->editColumn('priority', function ($row) {
                return $row->priority ? $row->priority : '';
            });
            $table->editColumn('is_repetitive', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_repetitive ? 'checked' : null) . '>';
            });
            $table->editColumn('repeat_interval_value', function ($row) {
                return $row->repeat_interval_value ? $row->repeat_interval_value : '';
            });
            $table->editColumn('repeat_interval_unit', function ($row) {
                return $row->repeat_interval_unit ? ToDo::REPEAT_INTERVAL_UNIT_SELECT[$row->repeat_interval_unit] : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'for_role', 'for_employee', 'is_repetitive']);

            return $table->make(true);
        }

        $roles     = Role::get();
        $employees = Employee::get();

        return view('admin.toDos.index', compact('roles', 'employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('to_do_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.toDos.create', compact('for_employees', 'for_roles'));
    }

    public function store(StoreToDoRequest $request)
    {
        $toDo = ToDo::create($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $toDo->id]);
        }

        return redirect()->route('admin.to-dos.index');
    }

    public function edit(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $toDo->load('for_roles', 'for_employee');

        return view('admin.toDos.edit', compact('for_employees', 'for_roles', 'toDo'));
    }

    public function update(UpdateToDoRequest $request, ToDo $toDo)
    {
        $toDo->update($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));

        return redirect()->route('admin.to-dos.index');
    }

    public function show(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->load('for_roles', 'for_employee');

        return view('admin.toDos.show', compact('toDo'));
    }

    public function destroy(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->delete();

        return back();
    }

    public function massDestroy(MassDestroyToDoRequest $request)
    {
        $toDos = ToDo::find(request('ids'));

        foreach ($toDos as $toDo) {
            $toDo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('to_do_create') && Gate::denies('to_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ToDo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
