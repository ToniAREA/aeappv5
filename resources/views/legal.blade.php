@extends('layouts.public')

@section('content')
<!-- Page Content-->
<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Legal Information</h1>

            <!-- Tabs navigation -->
            <ul class="nav nav-tabs" id="legalInfoTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="legal-tab" data-bs-toggle="tab" href="#legal" role="tab" aria-controls="legal" aria-selected="true">Legal Notice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="privacy-tab" data-bs-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cookies-tab" data-bs-toggle="tab" href="#cookies" role="tab" aria-controls="cookies" aria-selected="false">Cookie Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="terms-tab" data-bs-toggle="tab" href="#terms" role="tab" aria-controls="terms" aria-selected="false">Terms and Conditions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales Terms and Conditions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="returns-tab" data-bs-toggle="tab" href="#returns" role="tab" aria-controls="returns" aria-selected="false">Return Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="withdrawal-tab" data-bs-toggle="tab" href="#withdrawal" role="tab" aria-controls="withdrawal" aria-selected="false">Right of Withdrawal</a>
                </li>
            </ul>

            <!-- Tabs content -->
            <div class="tab-content" id="legalInfoTabContent">
                <!-- Legal Notice -->
                <div class="tab-pane fade show active" id="legal" role="tabpanel" aria-labelledby="legal-tab">
                    <h2>Legal Notice</h2>
                    <p>
                        All information regarding the ownership of the website, tax identification number, address, etc.
                    </p>
                </div>

                <!-- Privacy Policy -->
                <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                    <h2>Privacy Policy</h2>
                    <p>
                        Explanation of data collection, usage, who has access to the data, users' rights, etc.
                    </p>
                </div>

                <!-- Cookie Policy -->
                <div class="tab-pane fade" id="cookies" role="tabpanel" aria-labelledby="cookies-tab">
                    <h2>Cookie Policy</h2>
                    <p>
                        Description of the cookies used, types of cookies, and how to manage them.
                    </p>
                </div>

                <!-- Terms and Conditions -->
                <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                    <h2>Terms and Conditions</h2>
                    <p>
                        Rules regarding the use of the website, user rights, and responsibilities.
                    </p>
                </div>

                <!-- Sales Terms and Conditions -->
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                    <h2>Sales Terms and Conditions</h2>
                    <p>
                        Information about sales processes, payment methods, shipping policies, and return conditions.
                    </p>
                </div>

                <!-- Return Policy -->
                <div class="tab-pane fade" id="returns" role="tabpanel" aria-labelledby="returns-tab">
                    <h2>Return Policy</h2>
                    <p>
                        Details about product returns, refund conditions, etc.
                    </p>
                </div>

                <!-- Right of Withdrawal -->
                <div class="tab-pane fade" id="withdrawal" role="tabpanel" aria-labelledby="withdrawal-tab">
                    <h2>Right of Withdrawal</h2>
                    <p>
                        Explanation of the right of withdrawal and how to exercise it, deadlines, procedures, etc.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection