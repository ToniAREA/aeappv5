@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.clientsReview.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.clients-reviews.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $clientsReview->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.boats') }}
                                    </th>
                                    <td>
                                        @foreach($clientsReview->boats as $key => $boats)
                                            <span class="label label-info">{{ $boats->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $clientsReview->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.proforma') }}
                                    </th>
                                    <td>
                                        {{ $clientsReview->proforma->proforma_number ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.for_wlists') }}
                                    </th>
                                    <td>
                                        @foreach($clientsReview->for_wlists as $key => $for_wlists)
                                            <span class="label label-info">{{ $for_wlists->deadline }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.rating') }}
                                    </th>
                                    <td>
                                        {{ $clientsReview->rating }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.clientsReview.fields.shown_online') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $clientsReview->shown_online ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.clients-reviews.index') }}">
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