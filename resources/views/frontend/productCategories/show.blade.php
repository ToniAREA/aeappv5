@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.productCategory.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.product-categories.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $productCategory->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.is_online') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $productCategory->is_online ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.name') }}
                                        </th>
                                        <td>
                                            {{ $productCategory->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.category_slug') }}
                                        </th>
                                        <td>
                                            {{ $productCategory->category_slug }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.description') }}
                                        </th>
                                        <td>
                                            {!! $productCategory->description !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.photo') }}
                                        </th>
                                        <td>
                                            @if ($productCategory->photo)
                                                <a href="{{ $productCategory->photo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $productCategory->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.authorized_roles') }}
                                        </th>
                                        <td>
                                            @foreach ($productCategory->authorized_roles as $key => $authorized_roles)
                                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.productCategory.fields.authorized_users') }}
                                        </th>
                                        <td>
                                            @foreach ($productCategory->authorized_users as $key => $authorized_users)
                                                <span class="label label-info">{{ $authorized_users->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.product-categories.index') }}">
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
