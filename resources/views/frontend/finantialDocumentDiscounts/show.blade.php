@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.finantialDocumentDiscount.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.finantial-document-discounts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finantialDocumentDiscount.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $finantialDocumentDiscount->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finantialDocumentDiscount.fields.item') }}
                                    </th>
                                    <td>
                                        {{ $finantialDocumentDiscount->item->description ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finantialDocumentDiscount.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $finantialDocumentDiscount->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finantialDocumentDiscount.fields.discount_rate') }}
                                    </th>
                                    <td>
                                        {{ $finantialDocumentDiscount->discount_rate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.finantialDocumentDiscount.fields.discount_amount') }}
                                    </th>
                                    <td>
                                        {{ $finantialDocumentDiscount->discount_amount }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.finantial-document-discounts.index') }}">
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