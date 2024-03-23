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

class AssetCategoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('asset_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCategories = AssetCategory::with(['authorized_roles', 'authorized_users'])->get();

        $roles = Role::get();

        $users = User::get();

        return view('admin.assetCategories.index', compact('assetCategories', 'roles', 'users'));
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
