@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.finantialDocumentTax.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.finantial-document-taxes.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentTax.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $finantialDocumentTax->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentTax.fields.item') }}
                                        </th>
                                        <td>
                                            {{ $finantialDocumentTax->item->description ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentTax.fields.tax_type') }}
                                        </th>
                                        <td>
                                            {{ App\Models\FinantialDocumentTax::TAX_TYPE_RADIO[$finantialDocumentTax->tax_type] ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentTax.fields.tax_rate') }}
                                        </th>
                                        <td>
                                            {{ $finantialDocumentTax->tax_rate }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.finantialDocumentTax.fields.tax_amount') }}
                                        </th>
                                        <td>
                                            {{ $finantialDocumentTax->tax_amount }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.finantial-document-taxes.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
