<!-- View stored in resources/views/portfolio.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->

    <div class="container p-3 p-lg-4">
        <div class="row">
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

        </div>
        <div class="row gx-4 gx-lg-5">
            <div class="py-3 text-center">
                <h1>Our Recent Projects</h1>
                <p class="lead">Take a look at some of the latest projects we have completed for our clients. We pride ourselves on delivering top-notch solutions tailored to your needs.</p>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5">
            <!-- Project Card 1 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project1.jpg" class="card-img-top" alt="Luxury Yacht Automation">
                    <div class="card-body">
                        <h2 class="card-title">Luxury Yacht Automation</h2>
                        <p class="card-text">Implemented advanced automation systems on a luxury yacht, enhancing comfort and efficiency for the crew and guests.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Project Card 2 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project2.jpg" class="card-img-top" alt="Solar Energy Integration">
                    <div class="card-body">
                        <h2 class="card-title">Solar Energy Integration</h2>
                        <p class="card-text">Integrated solar panels and battery storage systems into a motor yacht, reducing reliance on traditional power sources.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Project Card 3 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project3.jpg" class="card-img-top" alt="Onboard Internet Solutions">
                    <div class="card-body">
                        <h2 class="card-title">Onboard Internet Solutions</h2>
                        <p class="card-text">Provided high-speed internet connectivity solutions for a fleet of sailing yachts, ensuring seamless communication at sea.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Project Card 4 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project4.jpg" class="card-img-top" alt="Navigation System Upgrade">
                    <div class="card-body">
                        <h2 class="card-title">Navigation System Upgrade</h2>
                        <p class="card-text">Upgraded the navigation systems on a commercial vessel, improving safety and operational efficiency.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Project Card 5 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project5.jpg" class="card-img-top" alt="Custom PLC Automation">
                    <div class="card-body">
                        <h2 class="card-title">Custom PLC Automation</h2>
                        <p class="card-text">Developed a custom PLC automation system for a superyacht, streamlining onboard operations.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Project Card 6 -->
            <div class="col-sm-6 col-md-4 mb-5">
                <div class="card h-100">
                    <img src="images/portfolio/project6.jpg" class="card-img-top" alt="Marine Alarm Systems">
                    <div class="card-body">
                        <h2 class="card-title">Marine Alarm Systems</h2>
                        <p class="card-text">Installed advanced alarm and monitoring systems on a fleet of boats, enhancing security and safety.</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">View Details</a></div>
                </div>
            </div>
            <!-- Additional projects can be added similarly -->
        </div>
    </div>

@endsection