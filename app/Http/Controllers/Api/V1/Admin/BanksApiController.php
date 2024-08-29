<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Resources\Admin\BankResource;
use App\Models\Bank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanksApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankResource(Bank::all());
    }

    public function store(StoreBankRequest $request)
    {
        $bank = Bank::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $bank->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($request->input('bank_logo', false)) {
            $bank->addMedia(storage_path('tmp/uploads/' . basename($request->input('bank_logo'))))->toMediaCollection('bank_logo');
        }

        return (new BankResource($bank))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bank $bank)
    {
        abort_if(Gate::denies('bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankResource($bank);
    }

    public function update(UpdateBankRequest $request, Bank $bank)
    {
        $bank->update($request->all());

        if (count($bank->files) > 0) {
            foreach ($bank->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $bank->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $bank->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        if ($request->input('bank_logo', false)) {
            if (! $bank->bank_logo || $request->input('bank_logo') !== $bank->bank_logo->file_name) {
                if ($bank->bank_logo) {
                    $bank->bank_logo->delete();
                }
                $bank->addMedia(storage_path('tmp/uploads/' . basename($request->input('bank_logo'))))->toMediaCollection('bank_logo');
            }
        } elseif ($bank->bank_logo) {
            $bank->bank_logo->delete();
        }

        return (new BankResource($bank))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bank $bank)
    {
        abort_if(Gate::denies('bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
