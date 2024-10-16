@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.asset.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $asset->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.is_available') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $asset->is_available ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.category') }}
                                        </th>
                                        <td>
                                            {{ $asset->category->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $asset->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.description') }}
                                        </th>
                                        <td>
                                            {!! $asset->description !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.photos') }}
                                        </th>
                                        <td>
                                            @foreach ($asset->photos as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.status') }}
                                        </th>
                                        <td>
                                            {{ $asset->status->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.location') }}
                                        </th>
                                        <td>
                                            {{ $asset->location->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.actual_holder') }}
                                        </th>
                                        <td>
                                            {{ $asset->actual_holder->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.notes') }}
                                        </th>
                                        <td>
                                            {{ $asset->notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.internal_notes') }}
                                        </th>
                                        <td>
                                            {{ $asset->internal_notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.data_1') }}
                                        </th>
                                        <td>
                                            {{ $asset->data_1 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.data_1_description') }}
                                        </th>
                                        <td>
                                            {{ $asset->data_1_description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.data_2') }}
                                        </th>
                                        <td>
                                            {{ $asset->data_2 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.data_2_description') }}
                                        </th>
                                        <td>
                                            {{ $asset->data_2_description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.files') }}
                                        </th>
                                        <td>
                                            @foreach ($asset->files as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.link_a') }}
                                        </th>
                                        <td>
                                            {{ $asset->link_a }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.link_a_description') }}
                                        </th>
                                        <td>
                                            {{ $asset->link_a_description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.link_b') }}
                                        </th>
                                        <td>
                                            {{ $asset->link_b }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.link_b_description') }}
                                        </th>
                                        <td>
                                            {{ $asset->link_b_description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.asset.fields.last_use') }}
                                        </th>
                                        <td>
                                            {{ $asset->last_use }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.assets.index') }}">
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
