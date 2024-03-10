@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.financialDocumentItem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.financial-document-items.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.financial-document-items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#item_finantial_document_taxes" role="tab" data-toggle="tab">
                {{ trans('cruds.finantialDocumentTax.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#item_finantial_document_discounts" role="tab" data-toggle="tab">
                {{ trans('cruds.finantialDocumentDiscount.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="item_finantial_document_taxes">
            @includeIf('admin.financialDocumentItems.relationships.itemFinantialDocumentTaxes', ['finantialDocumentTaxes' => $financialDocumentItem->itemFinantialDocumentTaxes])
        </div>
        <div class="tab-pane" role="tabpanel" id="item_finantial_document_discounts">
            @includeIf('admin.financialDocumentItems.relationships.itemFinantialDocumentDiscounts', ['finantialDocumentDiscounts' => $financialDocumentItem->itemFinantialDocumentDiscounts])
        </div>
    </div>
</div>

@endsection