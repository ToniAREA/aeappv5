@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.marina.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.marinas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $marina->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $marina->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.marina_photo') }}
                                    </th>
                                    <td>
                                        @if($marina->marina_photo)
                                            <a href="{{ $marina->marina_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $marina->marina_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.coordinates') }}
                                    </th>
                                    <td>
                                        {{ $marina->coordinates }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $marina->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $marina->link_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $marina->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.internal_notes') }}
                                    </th>
                                    <td>
                                        {{ $marina->internal_notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.contact_docs') }}
                                    </th>
                                    <td>
                                        {{ $marina->contact_docs->contact_first_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.last_use') }}
                                    </th>
                                    <td>
                                        {{ $marina->last_use }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.marinas.index') }}">
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