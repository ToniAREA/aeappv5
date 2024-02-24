@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.technicalDocumentation.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.technical-documentations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.show_online') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $technicalDocumentation->show_online ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.file') }}
                                    </th>
                                    <td>
                                        @if($technicalDocumentation->file)
                                            <a href="{{ $technicalDocumentation->file->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.doc_type') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->doc_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.brand') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->brand->brand ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.product') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->product->model ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.image') }}
                                    </th>
                                    <td>
                                        @if($technicalDocumentation->image)
                                            <a href="{{ $technicalDocumentation->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $technicalDocumentation->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.seo_meta_description') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->seo_meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.technicalDocumentation.fields.seo_slug') }}
                                    </th>
                                    <td>
                                        {{ $technicalDocumentation->seo_slug }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.technical-documentations.index') }}">
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