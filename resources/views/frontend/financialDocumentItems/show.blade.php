@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.financialDocumentItem.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.financial-document-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.financial_document') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->financial_document->reference_number ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.product') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->product->model ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.quantity') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.unit_price') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->unit_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.line_position') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->line_position }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.subtotal') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->subtotal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.financialDocumentItem.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $financialDocumentItem->total_amount }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.financial-document-items.index') }}">
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