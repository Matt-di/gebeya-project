@extends('layouts.app')

@section('content')
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right" style="
                      background: hsla(0, 0%, 100%, 0.55);
                      backdrop-filter: blur(30px);
                      ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">Sign up now</h2>
                            <form action=" {{ route('register') }} " method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="firstname" name="firstname"
                                                class="form-control @error('email') is-invalid @enderror" value="{{old('firstname')}}"/>
                                            <label class="form-label" for="firstname">First name</label>
                                            @error('firstname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="lastname" name="lastname"
                                                class="form-control @error('email') is-invalid @enderror" value="{{old('lastname')}}"/>
                                            <label class="form-label" for="lastname">Last name</label>
                                            @error('lastname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"/>
                                    <label class="form-label" for="email">Email address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" name="username"
                                        class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}"/>
                                    <label class="form-label" for="username">username </label>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('email') is-invalid @enderror" value="{{old('password')}}"/>
                                    <label class="form-label" for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control @error('email') is-invalid @enderror" value="{{old('password_confrimation')}}"/>
                                    <label class="form-label" for="password_confirmation">Repeate your
                                        password..</label>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input " type="radio" name="user_type"
                                        id="user_type" value="client" checked />
                                    <label class="form-check-label" for="inlineRadio1">Client</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="user_type" id="user_type"
                                        value="merchant" />
                                    <label class="form-check-label" for="inlineRadio2">Merchant</label>

                                </div>


                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Sign up
                                </button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Already an account? <a
                                        href=" {{ route('login') }}" class="link-danger">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
                        alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
@endsection
