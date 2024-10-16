@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.finalcialDocument.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.finalcial-documents.index') }}">
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
                                <a class="btn btn-default" href="{{ route('frontend.finalcial-documents.index') }}">
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
