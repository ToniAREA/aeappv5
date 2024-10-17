<!-- View stored in resources/views/portfolio.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->

    <div class="container-fluid">
        {{--  <div class="row">
            <div>
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel content here -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/portfolio/slide1.jpg" class="d-block w-100" alt="Project Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="images/portfolio/slide2.jpg" class="d-block w-100" alt="Project Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="images/portfolio/slide3.jpg" class="d-block w-100" alt="Project Slide 3">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div> --}}

        <div class="row gx-4 gx-lg-5">
            <div class="py-3 text-center">
                <h1>Our Recent Projects</h1>
                <p class="lead">Take a look at some of the latest projects we have completed for our clients. We pride
                    ourselves on delivering top-notch solutions tailored to your needs.</p>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5">
            @foreach ($pages as $page)
                <div class="col-sm-6 col-md-4 mb-5">
                    <div class="card h-100">
                        <!-- Cada carrusel necesita un id único -->
                        <div id="carousel-{{ $page->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($page->featured_image as $key => $media)
                                    <!-- Solo el primer elemento debe ser "active" -->
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ $media->getUrl() }}" class="card-img-top"
                                            alt="{{ $page->seo_title ?: $page->title }} - Featured Image"
                                            title="{{ $page->seo_title ?: $page->title }} - {{ $media->name }} image">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Botones para controlar el carrusel -->
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel-{{ $page->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel-{{ $page->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div class="card-body">
                            <h2 class="card-title">{{ $page->title }}</h2>

                            <!-- Meta description personalizada para SEO -->
                            <meta name="description"
                                content="{{ $page->seo_meta_description ?: Str::limit(strip_tags($page->excerpt), 160) }}">
                            {!! $page->excerpt !!}
                        </div>

                        <div class="card-footer">
                            <!-- Usamos el SEO slug si está disponible -->
                            <a class="btn btn-primary btn-sm" href="{{ url($page->seo_slug ?: $page->link) }}"
                                title="Read more about {{ $page->seo_title ?: $page->title }}">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </div>
@endsection
