<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class DocumentationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('documentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Documentation::with(['category', 'authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new Documentation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'documentation_show';
                $editGate      = 'documentation_edit';
                $deleteGate    = 'documentation_delete';
                $crudRoutePart = 'documentations';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('category.description', function ($row) {
                return $row->category ? (is_string($row->category) ? $row->category : $row->category->description) : '';
            });

            $table->editColumn('is_valid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_valid ? 'checked' : null) . '>';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('link_description', function ($row) {
                return $row->link_description ? $row->link_description : '';
            });
            $table->editColumn('authorized_roles', function ($row) {
                $labels = [];
                foreach ($row->authorized_roles as $authorized_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('authorized_users', function ($row) {
                $labels = [];
                foreach ($row->authorized_users as $authorized_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $authorized_user->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'is_valid', 'file', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        return view('admin.documentations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('documentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = DocumentationCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.documentations.create', compact('authorized_roles', 'authorized_users', 'categories'));
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

        return redirect()->route('admin.documentations.index');
    }

    public function edit(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = DocumentationCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $documentation->load('category', 'authorized_roles', 'authorized_users');

        return view('admin.documentations.edit', compact('authorized_roles', 'authorized_users', 'categories', 'documentation'));
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

        return redirect()->route('admin.documentations.index');
    }

    public function show(Documentation $documentation)
    {
        abort_if(Gate::denies('documentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documentation->load('category', 'authorized_roles', 'authorized_users');

        return view('admin.documentations.show', compact('documentation'));
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
