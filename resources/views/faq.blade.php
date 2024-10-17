@extends('layouts.public')
@section('content')

    <!-- Page Content-->
    <div class="container-fluid">
        <div class="row gx-4 gx-lg-5">
            <div class="py-3 text-center">
                <h1>Frequently Asked Questions</h1>
                <p class="lead">Find answers to some of the most common questions we receive. If you have any further inquiries, feel free to contact us for more information.</p>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5">
            @foreach ($faqs as $faq)
                <div class="col-sm-6 col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">{{ $faq->question }}</h2>
                            <p class="card-text">{{ $faq->answer }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
