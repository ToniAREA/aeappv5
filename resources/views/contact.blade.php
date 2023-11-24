@extends('layouts.public')
@section('content')
    <!-- Page Content-->
    <div class="container">

        <div class="row justify-content-center">
    <div class="col-lg-8 mt-3 text-center">
        <h1 class="display-5 fw-normal">Priority Service: Member-Exclusive</h1>
        <p class="fs-5 text-muted">
            In my commitment to deliver top-tier service, I have limited new memberships, focusing instead on a select group of VIP clients. Opportunities to join this exclusive group are available through a waiting list. I offer two distinct membership plans: SILVER and GOLD, each with limited availability due to high demand and my dedication to maintaining excellence. If your preferred plan is fully subscribed, you can be placed on the waiting list and, once a spot is available, enjoy benefits like preferential rates, fixed pricing, and priority service channels. This focused approach ensures each client receives the finest care for their yacht's electronics.
        </p>
    </div>
</div>


        <div class="row justify-content-center">
            <div class="mb-3 col-lg-8 col-12 d-flex">
                <img class="img-fluid rounded" src="images/gallery/vip-header-01.png" alt="" />
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row row-cols-1 row-cols-md-2 text-center">
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
                                    <li>10% discount in ALL materials</li>
                                </ul>
                                <button type="button" id="joinSilverButton"
                                    class="w-100 btn btn-lg btn-outline-secondary">Join SILVER</button>
                            </div>
                        </div>
                    </div>

                    <!-- VIP GOLD Membership -->
                    <div class="col">
                        <div class="card rounded-3 shadow-sm border-warning">
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
                                    <li>20% discount in ALL materials</li>
                                </ul>
                                <button type="button" id="joinGoldButton" class="w-100 btn btn-lg btn-warning">Join
                                    GOLD</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="fs-5 text-muted">
                        Secure your spot in this exclusive circle! Limited VIP Memberships available. VAT not
                        included.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal for VIP SILVER Membership -->
    <div class="modal fade" id="silverModal" tabindex="-1" aria-labelledby="silverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="silverModalLabel">Formulario de Membresía SILVER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario para SILVER -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for VIP GOLD Membership -->
    <div class="modal fade" id="goldModal" tabindex="-1" aria-labelledby="goldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goldModalLabel">Formulario de Membresía GOLD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario para GOLD -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('joinSilverButton').addEventListener('click', function() {
                new bootstrap.Modal(document.getElementById('silverModal')).show();
            });

            document.getElementById('joinGoldButton').addEventListener('click', function() {
                new bootstrap.Modal(document.getElementById('goldModal')).show();
            });
        });
    </script>
@endsection
