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
                @endcan
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
