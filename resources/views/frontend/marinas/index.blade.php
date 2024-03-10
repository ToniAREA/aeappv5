@extends('layouts.frontend')
@section('content')
<<<<<<< HEAD
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <a href="/home" class="btn btn-link text-white"><i class="fas fa-tachometer-alt"></i> Home</a>
                <a href="/clients" class="btn btn-link text-white"><i class="fa fa-users"></i> Clients</a>
                <a href="/boats" class="btn btn-link text-white"><i class="fa fa-ship"></i> boats</a>
                <a href="/wlists" class="btn btn-link text-white"><i class="fa fa-briefcase"></i> Works</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5><strong><i class="fas fa-anchor"></i> {{ strtoupper(trans('cruds.marina.title_singular')) }}
                            {{ strtoupper(trans('global.list')) }}</strong></h5>
                    @can('marina_create')
                        <div>
                            <a class="btn btn-success btn-sm mr-1" href="{{ route('frontend.marinas.create') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#csvImportModal">
                                {{ trans('global.app_csvImport') }}
                            </button>
                            @include('csvImport.modal', [
                                'model' => 'Marina',
                                'route' => 'admin.marinas.parseCsvImport',
                            ])
                        </div>
                    @endcan
=======
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('marina_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.marinas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.marina.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Marina', 'route' => 'admin.marinas.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.marina.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Marina">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.marina.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.marina_photo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.coordinates') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.contacts') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.contact_docs') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contactContact.fields.contact_email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.link') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.link_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.marina.fields.last_use') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($marinas as $key => $marina)
                                    <tr data-entry-id="{{ $marina->id }}">
                                        <td>
                                            {{ $marina->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($marina->marina_photo)
                                                <a href="{{ $marina->marina_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $marina->marina_photo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $marina->coordinates ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($marina->contacts as $key => $item)
                                                <span>{{ $item->contact_first_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $marina->contact_docs->contact_first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->contact_docs->contact_email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->link_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $marina->last_use ?? '' }}
                                        </td>
                                        <td>
                                            @can('marina_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.marinas.show', $marina->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('marina_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.marinas.edit', $marina->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('marina_delete')
                                                <form action="{{ route('frontend.marinas.destroy', $marina->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
>>>>>>> master
                </div>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marina name</th>
                            <th class="text-center">Boats counter</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marinas as $key => $marina)
                            <tr>
                                <td>{{ $marina->id }}</td>
                                @can('marina_show')
                                    <td> <a class="" href="{{ route('frontend.marinas.show', $marina->id) }}">

                                            {{ $marina->name ?? '' }}
                                        </a></td>
                                @else
                                    <td>
                                        {{ $marina->name ?? '' }}</td>
                                @endcan

                                <td class="text-center">{{ $marina->marinaBoats->count() }}</td>
                                <td class="text-center">
                                    @can('marina_delete')
                                        <form action="{{ route('frontend.marinas.destroy', $marina->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @can('marina_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('frontend.marinas.edit', $marina->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
