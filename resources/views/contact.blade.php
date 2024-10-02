@extends('layouts.public')
@section('content')
    <!-- Page Content-->
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8 m-3 text-center">
                <h1 class="display-5 fw-normal">VIP Yacht Electronics Priority Service Membership in Mallorca</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="mb-3 col-lg-8 col-12 d-flex">
                <img class="img-fluid rounded" src="images/gallery/vip-header-01.png" alt="VIP Yacht Electronics Service in Mallorca" />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-2 text-center">
                <p class="fs-5 text-muted">
                    To deliver top-tier yacht electronics services exclusively on the island of Mallorca, we focus on a select group of VIP clients, limiting new memberships. You can join this exclusive group via a waiting list. We offer two VIP membership plans: SILVER and GOLD, both with limited availability due to high demand and our dedication to excellence. If your preferred plan is full, join the waiting list to enjoy benefits like preferential rates, fixed pricing, and priority service. This ensures each client receives the best care for their yacht's electronics.
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row row-cols-1 row-cols-md-2 text-center">
                    <!-- VIP SILVER Membership -->
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h2 class="my-0 fw-normal">VIP SILVER</h2>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">€200<small class="text-muted fw-light">/month</small>
                                </h3>

                                <small class="text-muted fw-light">Anual plan. One payment.</small><br>
                                <small class="text-muted fw-light">€2.400</small>

                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>Guaranteed assistance<br>within 7 business days in Mallorca.</li><br>
                                    <li>€60 normal rate per hour</li>
                                    <li>€120 overtime rate per hour</li>
                                    <li>10% discount on all materials</li>
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
                                <h2 class="my-0 fw-normal">VIP GOLD</h2>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title pricing-card-title">€500<small class="text-muted fw-light">/month</small>
                                </h3>
                                <small class="text-muted fw-light">Bi-Anual plan. One payment.</small><br>
                                <small class="text-muted fw-light">€12.000</small>
                                
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>48-hour<br>guaranteed assistance in Mallorca.</li><br>
                                    <li>€50 normal rate per hour</li>
                                    <li>€100 overtime rate per hour</li>
                                    <li>20% discount on all materials</li>
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
                    <p class="fs-5 text-muted mt-2">
                        Secure your spot in this exclusive circle!<br>Limited VIP Memberships available.<br>VAT not included.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal for VIP SILVER Membership -->
    <div class="modal fade" id="silverModal" tabindex="-1" aria-labelledby="silverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="silverMembershipForm">
                    <div class="modal-header">
                        <h5 class="modal-title">VIP SILVER Membership Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Membership Form Fields -->
                        <!-- Step 1: User Inputs -->
                        <div id="silverFormStep1">
                            <div class="mb-3 text-center">
                                <img class="img-fluid rounded" src="images/gallery/vip-silver-header-01.webp" alt="VIP SILVER Yacht Electronics Service in Mallorca" />
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="boatName" class="form-label">Boat Name</label>
                                <input type="text" class="form-control" id="boatName" name="boatName" required>
                            </div>
                            <div class="mb-3">
                                <label for="mmsi" class="form-label">MMSI</label>
                                <input type="text" class="form-control" id="mmsi" name="mmsi" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobilePhone" class="form-label">Mobile Phone</label>
                                <input type="tel" class="form-control" id="mobilePhone" name="mobilePhone" required>
                            </div>
                        </div>
                        <!-- Step 2: Verification Code Input -->
                        <div id="silverFormStep2" style="display: none;">
                            <div class="mb-3">
                                <label for="verificationCode" class="form-label">Enter Verification Code</label>
                                <input type="text" class="form-control" id="verificationCode" name="verificationCode" required disabled>
                                <div class="form-text">A verification code has been sent to your email.</div>
                            </div>
                        </div>
                        <!-- Success Message -->
                        <div id="silverFormSuccess" style="display: none;">
                            <p>Your membership form has been submitted successfully!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="silverFormBackButton" class="btn btn-secondary" style="display: none;">Back</button>
                        <button type="submit" id="silverFormSubmitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for VIP GOLD Membership -->
    <div class="modal fade" id="goldModal" tabindex="-1" aria-labelledby="goldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="goldMembershipForm">
                    <div class="modal-header">
                        <h5 class="modal-title">VIP GOLD Membership Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Membership Form Fields -->
                        <!-- Step 1: User Inputs -->
                        <div id="goldFormStep1">
                            <div class="mb-3 text-center">
                                <img class="img-fluid rounded" src="images/gallery/vip-gold-header-01.webp" alt="VIP GOLD Yacht Electronics Service in Mallorca" />
                            </div>
                            <div class="mb-3">
                                <label for="goldFullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="goldFullName" name="goldFullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="goldBoatName" class="form-label">Boat Name</label>
                                <input type="text" class="form-control" id="goldBoatName" name="goldBoatName" required>
                            </div>
                            <div class="mb-3">
                                <label for="goldMmsi" class="form-label">MMSI</label>
                                <input type="text" class="form-control" id="goldMmsi" name="goldMmsi" required>
                            </div>
                            <div class="mb-3">
                                <label for="goldEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="goldEmail" name="goldEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="goldMobilePhone" class="form-label">Mobile Phone</label>
                                <input type="tel" class="form-control" id="goldMobilePhone" name="goldMobilePhone" required>
                            </div>
                        </div>
                        <!-- Step 2: Verification Code Input -->
                        <div id="goldFormStep2" style="display: none;">
                            <div class="mb-3">
                                <label for="goldVerificationCode" class="form-label">Enter Verification Code</label>
                                <input type="text" class="form-control" id="goldVerificationCode" name="goldVerificationCode" required disabled>
                                <div class="form-text">A verification code has been sent to your email.</div>
                            </div>
                        </div>
                        <!-- Success Message -->
                        <div id="goldFormSuccess" style="display: none;">
                            <p>Your membership form has been submitted successfully!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="goldFormBackButton" class="btn btn-secondary" style="display: none;">Back</button>
                        <button type="submit" id="goldFormSubmitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="goldModal" tabindex="-1" aria-labelledby="goldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">VIP GOLD Membership Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- VIP GOLD Membership Form goes here -->
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

   <script>
document.addEventListener('DOMContentLoaded', (event) => {
    const silverForm = document.getElementById('silverMembershipForm');
    const silverFormStep1 = document.getElementById('silverFormStep1');
    const silverFormStep2 = document.getElementById('silverFormStep2');
    const silverFormSuccess = document.getElementById('silverFormSuccess');
    const silverFormSubmitButton = document.getElementById('silverFormSubmitButton');
    const silverFormBackButton = document.getElementById('silverFormBackButton');
    const verificationCodeInput = document.getElementById('verificationCode');

    let verificationSent = false;

    silverForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!verificationSent) {
            // First step: Validate inputs and send verification code
            const fullName = document.getElementById('fullName').value.trim();
            const boatName = document.getElementById('boatName').value.trim();
            const mmsi = document.getElementById('mmsi').value.trim();
            const email = document.getElementById('email').value.trim();
            const mobilePhone = document.getElementById('mobilePhone').value.trim();

            // Client-side validation
            if (!fullName || !boatName || !mmsi || !email || !mobilePhone) {
                alert('Please fill in all fields.');
                return;
            }

            // Validate MMSI (should be a 9-digit number starting with 2-7)
            const mmsiRegex = /^[2-7]\d{8}$/;
            if (!mmsiRegex.test(mmsi)) {
                alert('Please enter a valid MMSI number.');
                return;
            }

            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }

            // Validate mobile phone (basic validation)
            const phoneRegex = /^\+?\d{7,15}$/;
            if (!phoneRegex.test(mobilePhone)) {
                alert('Please enter a valid mobile phone number.');
                return;
            }

            // Send AJAX request to send verification code
            fetch('{{ route('send.verification.code') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                verificationSent = true;
                silverFormStep1.style.display = 'none';
                silverFormStep2.style.display = 'block';
                silverFormBackButton.style.display = 'inline-block';
                verificationCodeInput.disabled = false; // Enable the input
            })
            .catch((error) => {
                console.error('Error:', error);
                if (error.errors) {
                    alert('Validation error: ' + Object.values(error.errors).join(', '));
                } else {
                    alert('An error occurred. Please try again.');
                }
            });

        } else {
            // Second step: Verify code and submit form
            const verificationCode = document.getElementById('verificationCode').value.trim();
            if (!verificationCode) {
                alert('Please enter the verification code.');
                return;
            }

            // Send AJAX request to verify code and submit form data
            const formData = {
                fullName: document.getElementById('fullName').value.trim(),
                boatName: document.getElementById('boatName').value.trim(),
                mmsi: document.getElementById('mmsi').value.trim(),
                email: document.getElementById('email').value.trim(),
                mobilePhone: document.getElementById('mobilePhone').value.trim(),
                verificationCode: verificationCode
            };

            fetch('{{ route('verify.code.and.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                verificationSent = false;
                silverFormStep2.style.display = 'none';
                silverFormBackButton.style.display = 'none';
                silverFormSubmitButton.style.display = 'none';
                silverFormSuccess.style.display = 'block';
                verificationCodeInput.disabled = true; // Disable the input
            })
            .catch((error) => {
                console.error('Error:', error);
                if (error.errors) {
                    alert('Validation error: ' + Object.values(error.errors).join(', '));
                } else if (error.message) {
                    alert(error.message);
                } else {
                    alert('An error occurred. Please try again.');
                }
            });
        }
    });

    silverFormBackButton.addEventListener('click', function() {
        verificationSent = false;
        silverFormStep1.style.display = 'block';
        silverFormStep2.style.display = 'none';
        silverFormBackButton.style.display = 'none';
        verificationCodeInput.disabled = true; // Disable the input
    });
});
</script>



@endsection