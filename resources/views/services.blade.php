<!-- View stored in resources/views/services.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->

    <div class="container px-3 px-lg-5">
        <!-- Heading Row -->
        <div class="row gx-4 gx-lg-5 align-items-center my-3">

            <div class="col-lg-7">
                <img class="img-fluid custom-img-size rounded mb-4 mb-lg-0"
                    src="images/photos/marine-electronics-main-bridge-04.jpeg" alt="Yacht Connectivity Solutions" />
            </div>


            <div class="col-lg-5 d-flex flex-column align-items-center text-center">
    <h1 class="font-weight-light">Tailored Marine Electronics</h1>
    <p>We specialize in bespoke electronic systems for luxury yachts, delivering robust internet connectivity,
        advanced navigation aids, and solar power solutions. Our expertise lies in crafting personalized
        solutions to enhance your maritime experience.</p>
    <a class="btn btn-primary" href="{{ route('portfolio') }}">Explore our work</a>
</div>
        </div>
        <!-- Call to Action -->
        <div class="card text-white bg-secondary my-5 py-4 text-center">
            <div class="card-body">
                <p class="text-white m-0">Enhance your yachting journey with our state-of-the-art custom electronics.
                    Discover the pinnacle of maritime technology with Area Electronica.</p>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row gx-4 gx-lg-5">

            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Internet & Connectivity</h2>
                        <p class="card-text">Stay connected wherever the seas may take you with our high-speed internet
                            solutions for yachts. Seamless communication and entertainment at your fingertips.</p>
                    </div>
                    <!-- Contenedor de la imagen -->
                    <div class="image-container">
                        <img src="images/photos/internet-onboard-yacht-01.jpeg" class="card-img-bottom"
                            alt="Descripción de la imagen">
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Solar & Battery Systems</h2>
                        <p class="card-text">Embrace the power of the sun with our advanced solar panel installations and
                            lithium battery systems, designed for efficiency and reliability on the open sea.</p>
                    </div>
                    <!-- Contenedor de la imagen -->
                    <div class="image-container">
                        <img src="images/photos/boat-solar-panels-01.jpeg" class="card-img-bottom"
                            alt="Solar panels on motor yacht">
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Custom Electronic Design</h2>
                        <p class="card-text">From navigation aids to onboard network systems, PLC automation, and remote
                            monitoring, we design and implement tailored solutions to meet your unique needs.</p>
                    </div>
                    <!-- Contenedor de la imagen -->
                    <div class="image-container">
                        <img src="images/photos/marine-custom-electronics-01.jpeg" class="card-img-bottom"
                            alt="Custom electronic PCB for boat alarm system">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
