<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrencyRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrenciesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('currency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currencies = Currency::all();

        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('currency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.currencies.create');
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::create($request->all());

        return redirect()->route('admin.currencies.index');
    }

    public function edit(Currency $currency)
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.currencies.edit', compact('currency'));
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());

        return redirect()->route('admin.currencies.index');
    }

    public function show(Currency $currency)
    {
        abort_if(Gate::denies('currency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->load('currencyPayments', 'currencyFinalcialDocuments');

        return view('admin.currencies.show', compact('currency'));
    }

    public function destroy(Currency $currency)
    {
        abort_if(Gate::denies('currency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrencyRequest $request)
    {
        $currencies = Currency::find(request('ids'));

        foreach ($currencies as $currency) {
            $currency->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
