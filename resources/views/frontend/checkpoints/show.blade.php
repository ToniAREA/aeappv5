@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.checkpoint.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.checkpoints.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $checkpoint->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $checkpoint->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $checkpoint->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.is_available') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $checkpoint->is_available ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.file') }}
                                    </th>
                                    <td>
                                        @if($checkpoint->file)
                                            <a href="{{ $checkpoint->file->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.photo') }}
                                    </th>
                                    <td>
                                        @if($checkpoint->photo)
                                            <a href="{{ $checkpoint->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $checkpoint->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkpoint.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $checkpoint->price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.checkpoints.index') }}">
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