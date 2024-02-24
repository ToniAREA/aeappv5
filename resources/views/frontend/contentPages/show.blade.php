@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.contentPage.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.content-pages.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.show_online') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contentPage->show_online ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.category') }}
                                    </th>
                                    <td>
                                        @foreach($contentPage->categories as $key => $category)
                                            <span class="label label-info">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.tag') }}
                                    </th>
                                    <td>
                                        @foreach($contentPage->tags as $key => $tag)
                                            <span class="label label-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.page_text') }}
                                    </th>
                                    <td>
                                        {!! $contentPage->page_text !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.excerpt') }}
                                    </th>
                                    <td>
                                        {!! $contentPage->excerpt !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.featured_image') }}
                                    </th>
                                    <td>
                                        @foreach($contentPage->featured_image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.file') }}
                                    </th>
                                    <td>
                                        @foreach($contentPage->file as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_meta_description') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->seo_meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_slug') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->seo_slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_a') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->link_a }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_a_description') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->link_a_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.show_online_link_a') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contentPage->show_online_link_a ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_b') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->link_b }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_b_description') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->link_b_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.show_online_link_b') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $contentPage->show_online_link_b ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.view_count') }}
                                    </th>
                                    <td>
                                        {{ $contentPage->view_count }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.content-pages.index') }}">
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