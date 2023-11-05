<!-- View stored in resources/views/contact.blade.php -->

@extends('layouts.public')
@section('content')
    <!-- Page Content-->
    <div class="container px-3 p-lg-4">
        <div class="row">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-5 fw-normal">Membership Plans</h1>
                <p class="fs-5 text-muted">
                    Join our exclusive VIP Membership to ensure your yacht's electronics are always in top condition. With
                    limited spots available, secure your bi-annual contract today to enjoy not only guaranteed support and
                    preferential rates but also fixed pricing throughout the term of your agreement and access to priority
                    communication channels for expedited service.

                </p>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center justify-content-center">
            <!-- VIP SILVER Membership -->
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">VIP SILVER</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€499<small class="text-muted fw-light">/mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Guaranteed assistance <br> within 7 business days</li>
                            <li>€60 normal rate per hour</li>
                            <li>€120 overtime rate per hour</li>
                            <br>
                            <li>10% discount in all materials</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-outline-secondary">Join SILVER</button>
                    </div>
                </div>
            </div>

            <!-- VIP GOLD Membership -->
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-warning">
                    <div class="card-header py-3 text-white bg-warning border-warning">
                        <h4 class="my-0 fw-normal">VIP GOLD</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">€999<small class="text-muted fw-light">/mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>48-hours<br>guaranteed assistance in Mallorca</li>
                            <li>€50 normal rate per hour</li>
                            <li>€100 overtime rate per hour</li>
                            <br>
                            <li>20% discount in all materials</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-warning">Join GOLD</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <p class="fs-5 text-muted">
                    Limited slots available. Contact us today to secure your VIP Membership. VAT not included.
                </p>
            </div>
        </div>
    </div>
@endsection
