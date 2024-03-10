<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFaqCategoryRequest;
use App\Http\Requests\StoreFaqCategoryRequest;
use App\Http\Requests\UpdateFaqCategoryRequest;
use App\Models\FaqCategory;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FaqCategoryController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('faq_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FaqCategory::with(['authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new FaqCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'faq_category_show';
                $editGate      = 'faq_category_edit';
                $deleteGate    = 'faq_category_delete';
                $crudRoutePart = 'faq-categories';

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
            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
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

            $table->rawColumns(['actions', 'placeholder', 'photo', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        $roles = Role::get();
        $users = User::get();

        return view('admin.faqCategories.index', compact('roles', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('faq_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.faqCategories.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreFaqCategoryRequest $request)
    {
        $faqCategory = FaqCategory::create($request->all());
        $faqCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $faqCategory->id]);
        }

        return redirect()->route('admin.faq-categories.index');
    }

    public function edit(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $faqCategory->load('authorized_roles', 'authorized_users');

        return view('admin.faqCategories.edit', compact('authorized_roles', 'authorized_users', 'faqCategory'));
    }

    public function update(UpdateFaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        $faqCategory->update($request->all());
        $faqCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $faqCategory->authorized_users()->sync($request->input('authorized_users', []));
        if ($request->input('photo', false)) {
            if (! $faqCategory->photo || $request->input('photo') !== $faqCategory->photo->file_name) {
                if ($faqCategory->photo) {
                    $faqCategory->photo->delete();
                }
                $faqCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($faqCategory->photo) {
            $faqCategory->photo->delete();
        }

        return redirect()->route('admin.faq-categories.index');
    }

    public function show(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqCategory->load('authorized_roles', 'authorized_users');

        return view('admin.faqCategories.show', compact('faqCategory'));
    }

    public function destroy(FaqCategory $faqCategory)
    {
        abort_if(Gate::denies('faq_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyFaqCategoryRequest $request)
    {
        $faqCategories = FaqCategory::find(request('ids'));

        foreach ($faqCategories as $faqCategory) {
            $faqCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('faq_category_create') && Gate::denies('faq_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FaqCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
