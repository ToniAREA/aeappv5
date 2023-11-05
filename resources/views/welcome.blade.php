<!-- View stored in resources/views/welcome.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->

    <!-- Header-->
    <header class="py-3">
        <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center bg-image">
                <div class="m-4 m-lg-5" style="background: rgba(255, 255, 255, 0.8); border-radius: 15px;">
                    <h1 class="display-5 fw-bold">Need assistance?</h1>
                    <p class="fs-4">
                        At Area Electronica, we specialize in custom-tailored electronic solutions for private yachts. Our
                        commitment lies in delivering exceptional quality and personalized service. Should you have any
                        queries or require assistance, we're just a message away.
                    </p>
                    <!-- resources/views/your-view.blade.php -->
                    <a href="https://wa.me/34620480228?text=I%27m%20interested%20in%20your%20custom%20electronic%20solutions.%20Please%20reach%20out%20to%20me%20at%20your%20earliest%20convenience."
                        target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">Contact Us on WhatsApp</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Page Content-->
    <div class="container px-lg-5 py-3">
        <div class="row text-center">
            <!-- Clients Count -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $clientsCount }}" data-speed="5000"></h2>
                    <p class="count-text">Clients</p>
                </div>
            </div>

            <!-- Boats Worked On Count -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $boatsCount }}" data-speed="5000"></h2>
                    <p class="count-text">Boats Worked On</p>
                </div>
            </div>

            <!-- Jobs Done Count -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $worksCount }}" data-speed="5000"></h2>
                    <p class="count-text">Jobs Completed</p>
                </div>
            </div>

            <!-- Years of Experience Count -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="counter">
                    <h2 class="timer count-title count-number" data-to="{{ $yearsSince }}" data-speed="5000"></h2>
                    <p class="count-text">Years of Experience</p>
                </div>
            </div>
        </div>

        <!-- Page Features-->
        <div class="row gx-lg-5 justify-content-center">
            <!-- Custom feature block for number of clients -->
            <div class="col-lg-6 col-xxl-4 mb-5">
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
            <div class="col-lg-6 col-xxl-4 mb-5">
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
            <!-- Custom feature block for number of jobs completed -->
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-journal-check"></i></div>
                        <h2 class="fs-4 fw-bold">Jobs Completed</h2>
                        <p class="mb-0">A total of {{ $worksCount }} installations completed to date, reflecting our
                            extensive
                            experience and dedication to quality.</p>
                    </div>
                </div>
            </div>
            <!-- Custom feature block for years of experience -->
            <div class="col-lg-6 col-xxl-6 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                class="bi bi-calendar3"></i></div>
                        <h2 class="fs-4 fw-bold">Decades of Expertise</h2>
                        <p class="mb-0">Over {{ $yearsSince }} years of experience in marine electronics, delivering
                            bespoke
                            solutions for yachts and boats.</p>
                    </div>
                </div>
            </div>
            <!-- Here you can continue with other features or information blocks -->
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
