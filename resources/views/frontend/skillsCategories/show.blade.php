@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.skillsCategory.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.skills-categories.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.skillsCategory.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $skillsCategory->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.skillsCategory.fields.subject') }}
                                        </th>
                                        <td>
                                            {{ $skillsCategory->subject }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.skillsCategory.fields.description') }}
                                        </th>
                                        <td>
                                            {{ $skillsCategory->description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.skillsCategory.fields.photo') }}
                                        </th>
                                        <td>
                                            @if ($skillsCategory->photo)
                                                <a href="{{ $skillsCategory->photo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $skillsCategory->photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.skills-categories.index') }}">
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
