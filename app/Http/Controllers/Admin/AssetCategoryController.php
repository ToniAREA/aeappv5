<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssetCategoryRequest;
use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use App\Models\AssetCategory;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssetCategory::with(['authorized_roles', 'authorized_users'])->select(sprintf('%s.*', (new AssetCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'asset_category_show';
                $editGate      = 'asset_category_edit';
                $deleteGate    = 'asset_category_delete';
                $crudRoutePart = 'asset-categories';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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

            $table->rawColumns(['actions', 'placeholder', 'authorized_roles', 'authorized_users']);

            return $table->make(true);
        }

        $roles = Role::get();
        $users = User::get();

        return view('admin.assetCategories.index', compact('roles', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('asset_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        return view('admin.assetCategories.create', compact('authorized_roles', 'authorized_users'));
    }

    public function store(StoreAssetCategoryRequest $request)
    {
        $assetCategory = AssetCategory::create($request->all());
        $assetCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $assetCategory->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('admin.asset-categories.index');
    }

    public function edit(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authorized_roles = Role::pluck('title', 'id');

        $authorized_users = User::pluck('name', 'id');

        $assetCategory->load('authorized_roles', 'authorized_users');

        return view('admin.assetCategories.edit', compact('assetCategory', 'authorized_roles', 'authorized_users'));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory)
    {
        $assetCategory->update($request->all());
        $assetCategory->authorized_roles()->sync($request->input('authorized_roles', []));
        $assetCategory->authorized_users()->sync($request->input('authorized_users', []));

        return redirect()->route('admin.asset-categories.index');
    }

    public function show(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->load('authorized_roles', 'authorized_users');

        return view('admin.assetCategories.show', compact('assetCategory'));
    }

    public function destroy(AssetCategory $assetCategory)
    {
        abort_if(Gate::denies('asset_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetCategoryRequest $request)
    {
        $assetCategories = AssetCategory::find(request('ids'));

        foreach ($assetCategories as $assetCategory) {
            $assetCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
