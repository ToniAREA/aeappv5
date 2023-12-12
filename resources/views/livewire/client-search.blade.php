<div>
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Buscar cliente..." wire:model="search">
        </div>
    </div>
    <br>
    <div class="row">
        <!-- Card 1 -->
        @foreach ($clientsearch as $key => $client)
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
