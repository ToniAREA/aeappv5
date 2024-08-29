@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.faqQuestion.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.faq-questions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $faqQuestion->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.is_online') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $faqQuestion->is_online ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $faqQuestion->category->category ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.question') }}
                                    </th>
                                    <td>
                                        {!! $faqQuestion->question !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.answer') }}
                                    </th>
                                    <td>
                                        {!! $faqQuestion->answer !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($faqQuestion->photo)
                                            <a href="{{ $faqQuestion->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $faqQuestion->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.files') }}
                                    </th>
                                    <td>
                                        @foreach($faqQuestion->files as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.view_count') }}
                                    </th>
                                    <td>
                                        {{ $faqQuestion->view_count }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.authorized_roles') }}
                                    </th>
                                    <td>
                                        @foreach($faqQuestion->authorized_roles as $key => $authorized_roles)
                                            <span class="label label-info">{{ $authorized_roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.faqQuestion.fields.authorized_users') }}
                                    </th>
                                    <td>
                                        @foreach($faqQuestion->authorized_users as $key => $authorized_users)
                                            <span class="label label-info">{{ $authorized_users->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.faq-questions.index') }}">
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