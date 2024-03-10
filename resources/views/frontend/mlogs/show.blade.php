@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.mlog.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mlogs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $mlog->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.boat') }}
                                    </th>
                                    <td>
                                        {{ $mlog->boat->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.boat_namecomplete') }}
                                    </th>
                                    <td>
                                        {{ $mlog->boat_namecomplete }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.wlist') }}
                                    </th>
                                    <td>
                                        {{ $mlog->wlist->description ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $mlog->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $mlog->employee->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.item') }}
                                    </th>
                                    <td>
                                        {{ $mlog->item }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.product') }}
                                    </th>
                                    <td>
                                        {{ $mlog->product->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $mlog->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.photos') }}
                                    </th>
                                    <td>
                                        @foreach($mlog->photos as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.units') }}
                                    </th>
                                    <td>
                                        {{ $mlog->units }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.price_unit') }}
                                    </th>
                                    <td>
                                        {{ $mlog->price_unit }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.invoiced_line') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $mlog->invoiced_line ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.internal_notes') }}
                                    </th>
                                    <td>
                                        {{ $mlog->internal_notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mlog.fields.financial_document') }}
                                    </th>
                                    <td>
                                        {{ $mlog->financial_document->reference_number ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.mlogs.index') }}">
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