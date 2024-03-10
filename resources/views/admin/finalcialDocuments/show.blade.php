@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.finalcialDocument.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finalcial-documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.id') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.doc_type') }}
                        </th>
                        <td>
                            {{ App\Models\FinalcialDocument::DOC_TYPE_RADIO[$finalcialDocument->doc_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.reference_number') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->reference_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\FinalcialDocument::STATUS_RADIO[$finalcialDocument->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.client') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.issue_date') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->issue_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.due_date') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->due_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.currency') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->currency->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.subtotal') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->subtotal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.total_taxes') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->total_taxes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.total_discounts') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->total_discounts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.total_amount') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->total_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.payment_terms') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->payment_terms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.security_code') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->security_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.notes') }}
                        </th>
                        <td>
                            {{ $finalcialDocument->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finalcial-documents.index') }}">
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
            <a class="nav-link" href="#financial_document_financial_document_items" role="tab" data-toggle="tab">
                {{ trans('cruds.financialDocumentItem.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_assets_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsRental.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#financial_document_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="financial_document_financial_document_items">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentFinancialDocumentItems', ['financialDocumentItems' => $finalcialDocument->financialDocumentFinancialDocumentItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_payments">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentPayments', ['payments' => $finalcialDocument->financialDocumentPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_assets_rentals">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentAssetsRentals', ['assetsRentals' => $finalcialDocument->financialDocumentAssetsRentals])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_wlists">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentWlists', ['wlists' => $finalcialDocument->financialDocumentWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_wlogs">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentWlogs', ['wlogs' => $finalcialDocument->financialDocumentWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_mlogs">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentMlogs', ['mlogs' => $finalcialDocument->financialDocumentMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_booking_lists">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentBookingLists', ['bookingLists' => $finalcialDocument->financialDocumentBookingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_suscriptions">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentSuscriptions', ['suscriptions' => $finalcialDocument->financialDocumentSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_maintenance_suscriptions">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentMaintenanceSuscriptions', ['maintenanceSuscriptions' => $finalcialDocument->financialDocumentMaintenanceSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="financial_document_iot_suscriptions">
            @includeIf('admin.finalcialDocuments.relationships.financialDocumentIotSuscriptions', ['iotSuscriptions' => $finalcialDocument->financialDocumentIotSuscriptions])
        </div>
    </div>
</div>

@endsection