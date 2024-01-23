@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="card my-2">
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
