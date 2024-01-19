<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\Admin\ExpenseResource;
use App\Models\Expense;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseResource(Expense::with(['expense_category'])->get());
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());

        if ($request->input('file', false)) {
            $expense->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($request->input('photo', false)) {
            $expense->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExpenseResource($expense->load(['expense_category']));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        if ($request->input('file', false)) {
            if (! $expense->file || $request->input('file') !== $expense->file->file_name) {
                if ($expense->file) {
                    $expense->file->delete();
                }
                $expense->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($expense->file) {
            $expense->file->delete();
        }

        if ($request->input('photo', false)) {
            if (! $expense->photo || $request->input('photo') !== $expense->photo->file_name) {
                if ($expense->photo) {
                    $expense->photo->delete();
                }
                $expense->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($expense->photo) {
            $expense->photo->delete();
        }

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
