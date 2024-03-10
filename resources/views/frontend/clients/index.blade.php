@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <a href="/home" class="btn btn-link text-white"><i class="fas fa-tachometer-alt"></i> Home</a>
                <a href="/boats" class="btn btn-link text-white"><i class="fa fa-ship"></i> Boats</a>
                <a href="/marinas" class="btn btn-link text-white"><i class="fa fa-anchor"></i> Marinas</a>
                <a href="/wlists" class="btn btn-link text-white"><i class="fa fa-briefcase"></i> Works</a>
            </div>
        </div>
        <div class="row justify-content-center">
            
            @livewire('client-search')

            <div class="col-md-6">
                @can('client_create')
                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-success" href="{{ route('frontend.clients.create') }}">
                                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
                            </a>
                        </div>
                    </div>
<<<<<<< HEAD
                @endcan
=======
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.client.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Client">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.client.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.has_active_vip_plan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.defaulter') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.ref') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.lastname') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.vat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.telephone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.contacts') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.boats') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.coordinates') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.link_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.link_a_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.link_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.link_b_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.client.fields.last_use') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($contact_contacts as $key => $item)
                                                <option value="{{ $item->contact_first_name }}">{{ $item->contact_first_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($boats as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $key => $client)
                                    <tr data-entry-id="{{ $client->id }}">
                                        <td>
                                            {{ $client->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $client->has_active_vip_plan ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $client->has_active_vip_plan ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $client->defaulter ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $client->defaulter ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $client->ref ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->lastname ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->vat ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->country ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->telephone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->email ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($client->contacts as $key => $item)
                                                <span>{{ $item->contact_first_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($client->boats as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $client->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->coordinates ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->link_a ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->link_a_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->link_b ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->link_b_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $client->last_use ?? '' }}
                                        </td>
                                        <td>
                                            @can('client_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.clients.show', $client->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('client_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.clients.edit', $client->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('client_delete')
                                                <form action="{{ route('frontend.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                </div>
>>>>>>> master
            </div>

        </div>

        <div class="row">
            <!-- Card 1 -->
            @foreach ($clients as $key => $client)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card custom-card">
                        <div class="card-header bg-secondary text-white">{{ $client->id ?: '' }} - {{ $client->name ?: '' }}
                            {{ $client->lastname ?: '' }}
                        </div>
                        <div class="card-body">Cuerpo</div>
                        <div class="card-footer">Pie de página</div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
@section('scripts')
    @parent
@endsection
