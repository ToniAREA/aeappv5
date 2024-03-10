@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.faqCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.faq-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $faqCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.category') }}
                        </th>
                        <td>
                            {{ $faqCategory->category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $faqCategory->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.photo') }}
                        </th>
                        <td>
                            @if($faqCategory->photo)
                                <a href="{{ $faqCategory->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $faqCategory->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.authorized_roles') }}
                        </th>
                        <td>
                            @foreach($faqCategory->authorized_roles as $key => $authorized_roles)
                                <span class="label label-info">{{ $authorized_roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.faqCategory.fields.authorized_users') }}
                        </th>
                        <td>
                            @foreach($faqCategory->authorized_users as $key => $authorized_users)
                                <span class="label label-info">{{ $authorized_users->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.faq-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection