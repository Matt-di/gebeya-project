@extends('layouts.app')


@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container h-100 my-5 py-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item pl-0">
                            <a class="nav-link active" href="{{ route('home') }}">Home</a>
                        </li>
                        @for ($i = 1; $i <= count(Request::segments()); $i++)
                            <li class="nav-item">
                                @if (($i == count(Request::segments())) & ($i > 0))
                                    <a class="nav-link disabled" href="">{{ Request::segment($i) }}</a>
                                @else
                                    <a class="nav-link active" href="">{{ Request::segment($i) }}</a>
                                @endif
                            </li>
                        @endfor
                    </ul>

                </div>
            </nav>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Thanks for Shopping with us! </h5>
                            <h5> Dear<span style="color: #a8729a;"> User</span> Your order
                                has been placed, !
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Order </p>
                                <p class="small text-muted mb-0">Order Code :
                                    <a href="4">#{{ $orders->id }}</a>
                                </p>
                            </div>
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Ordered Products</p>
                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-6">
                                            <p class="text-muted mb-0 small">Total {{ $orders->total }} Products
                                                Ordered.
                                            </p>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Order status :
                                                    {{ $orders->status }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <a href="/" class="btn btn-primary">Shop Again</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
