@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
       
        <div class="row justify-content-center">

            <div class="col">
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
