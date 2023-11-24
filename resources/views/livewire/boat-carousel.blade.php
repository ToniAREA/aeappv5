<div class="carousel-inner">
    @foreach ($images as $image)
        <div class="carousel-item">
            <img src="{{ $image->url }}" alt="Imagen del barco">
        </div>
    @endforeach
</div>
