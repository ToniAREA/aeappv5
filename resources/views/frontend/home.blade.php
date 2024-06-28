@extends('layouts.frontend')

@section('content')
    <div class="container-fluid">
        <!-- Logged users home/dashboard page -->
        
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="dashcard">
                <div class="dashcard-content">
                    <div class="dashcard-number">294</div>
                    <div class="dashcard-info">
                        <h2>MY WOLKE 7</h2>
                        <p>Lithium service battery bank</p>
                    </div>
                    <div class="dashcard-progress">
                        <span>723 days</span>
                        <span>PROGRESS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
