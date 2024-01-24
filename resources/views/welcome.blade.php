<!-- View stored in resources/views/welcome.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->

    <!-- Header-->
    <header class="py-3">
        <div class="container-fluid px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center bg-image">
                <div class="m-4 m-lg-5" style="background: rgba(255, 255, 255, 0.8); border-radius: 20px;">
                    <h2 class="display-5 fw-bold">Top-Notch Yacht Electronics</h2>
                    <p class="fs-5">
                        Welcome to Area Electronica, where I specialize in bespoke electronic services tailored exclusively for private yachts. My dedication is to provide unparalleled quality and personalized service. If you have any questions or need assistance, I'm here to help – just a message away.
                    </p>
                    <!-- resources/views/your-view.blade.php -->
                    <a href="https://wa.me/34620480228?text=Please%20reach%20out%20to%20me%20at%20your%20earliest%20convenience."
                        target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">Contact Us on WhatsApp</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content-->
    <div class="container px-lg-5 py-3">
        <div class="row text-center">
            <!-- Clients Count -->
            <div class="col-lg-3 col-md-3 col-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $clientsCount }}" data-speed="5000"></h2>
                    <p class="count-text">Clients</p>
                </div>
            </div>

            <!-- Boats Worked On Count -->
            <div class="col-lg-3 col-md-3 col-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $boatsCount }}" data-speed="5000"></h2>
                    <p class="count-text">Boats Worked On</p>
                </div>
            </div>

            <!-- Jobs Done Count -->
            <div class="col-lg-3 col-md-3 col-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $worksCount }}" data-speed="5000"></h2>
                    <p class="count-text">Projects Completed</p>
                </div>
            </div>

            <!-- Years of Experience Count -->
            <div class="col-lg-3 col-md-3 col-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $yearsSince }}" data-speed="5000"></h2>
                    <p class="count-text">Years of Experience</p>
                </div>
            </div>
        </div>

        <!-- Page Features-->
        <div class="row gx-lg-5 justify-content-center">
            <!-- Custom feature block for years of experience -->
            <div class="col-lg-10 col-xxl-10 mb-4">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-calendar3"></i></div>
                        <h2 class="fs-4 fw-bold">Decades of Expertise</h2>
                        <p class="mb-0">Over {{ $yearsSince }} years of experience in marine electronics, delivering
                            bespoke
                            solutions for yachts and boats.
                        <p>
                        <p> Since 1996, we have been passionately devoted to electronics, electricity, and computing, with a
                            specialization in maritime technology. Our expertise primarily lies in servicing private
                            vessels, including both sailboats and motorboats. Renowned for our adept troubleshooting skills,
                            we excel in crafting tailor-made technological solutions that cater uniquely to each case or
                            client.</p>
                        <p>
                            Our preferred brands include Pepwave, Raymarine, Mastervolt, KVH, Victron, Furuno, Maretron,
                            Fusion, Airmar, among others, ensuring quality and reliability in every project.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-lg-5 justify-content-center">
            <!-- Custom feature block for number of clients -->
            <div class="col-lg-6 col-xxl-4 mb-3">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-people"></i></div>
                        <h2 class="fs-4 fw-bold">Trusted by Clients</h2>
                        <p class="mb-0">With a strong clientele of {{ $clientsCount }}, we pride ourselves on
                            delivering exceptional
                            service to every customer.</p>
                    </div>
                </div>
            </div>
            <!-- Custom feature block for number of boats worked on -->
            <div class="col-lg-6 col-xxl-4 mb-3">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-speedometer2"></i></div>
                        <h2 class="fs-4 fw-bold">Boats Serviced</h2>
                        <p class="mb-0">{{ $boatsCount }} boats have been equipped and upgraded with our
                            cutting-edge technology
                            solutions.</p>
                    </div>
                </div>
            </div>
            <!-- Custom feature block for number of Projects completed -->
            <div class="col-lg-6 col-xxl-4 mb-3">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-journal-check"></i></div>
                        <h2 class="fs-4 fw-bold">Projects Completed</h2>
                        <p class="mb-0">A total of {{ $worksCount }} installations completed to date, reflecting our
                            extensive
                            experience and dedication to quality.</p>
                    </div>
                </div>
            </div>

            <!-- Here you can continue with other features or information blocks -->
        </div>

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

    <script>
        // Simple counter function
        function countUp(el) {
            const target = +el.getAttribute('data-to');
            const step = target / 100;

            let currentNumber = 0;
            const timer = setInterval(function() {
                currentNumber += step;
                if (currentNumber > target) {
                    clearInterval(timer);
                    currentNumber = target;
                }
                el.textContent = Math.ceil(currentNumber);
            }, el.getAttribute('data-speed') / 100);
        }

        // Get all the elements with class 'count-number'
        const counters = document.querySelectorAll('.count-number');

        // For each element, start the count up animation
        counters.forEach(counter => {
            countUp(counter);
        });
    </script>
@endsection
