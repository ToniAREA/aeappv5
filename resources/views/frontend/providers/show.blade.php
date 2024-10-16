@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.provider.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.providers.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $provider->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.is_active') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $provider->is_active ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $provider->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.company') }}
                                        </th>
                                        <td>
                                            {{ $provider->company->company_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.provider_logo') }}
                                        </th>
                                        <td>
                                            @if ($provider->provider_logo)
                                                <a href="{{ $provider->provider_logo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $provider->provider_logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.provider_url') }}
                                        </th>
                                        <td>
                                            {{ $provider->provider_url }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.brands') }}
                                        </th>
                                        <td>
                                            @foreach ($provider->brands as $key => $brands)
                                                <span class="label label-info">{{ $brands->brand }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.price_lists') }}
                                        </th>
                                        <td>
                                            @foreach ($provider->price_lists as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.notes') }}
                                        </th>
                                        <td>
                                            {{ $provider->notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.internal_notes') }}
                                        </th>
                                        <td>
                                            {{ $provider->internal_notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.status') }}
                                        </th>
                                        <td>
                                            {{ $provider->status }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.link') }}
                                        </th>
                                        <td>
                                            {{ $provider->link }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.provider.fields.link_description') }}
                                        </th>
                                        <td>
                                            {{ $provider->link_description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.providers.index') }}">
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
