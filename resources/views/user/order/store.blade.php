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
            <div class="row my-3 d-flex justify-content-center">
                <div class="col-md-6 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3 sticky-top">
                        <?php $total = 0; ?>
                        @foreach ($carts as $cart)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $cart['name'] }}</h6>
                                    <small class="text-muted">{{ $cart['qty'] }}</small>
                                </div>
                                <span class="text-muted">${{ $cart['qty'] * $cart['price'] }}</span>
                            </li>
                            <?php $total += $cart['price'] * $cart['qty']; ?>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between lh-condensed">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total ()</span>
                            <strong>${{ $total }}</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-5">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h3>Customer Details</h3>
                            </div>
                            <form action="{{ route('order.add', 1) }}" method="POST">
                                @csrf
                                <p class="fw-bold mb-4 pb-2">Fill</p>
                                <div class="d-flex flex-row align-items-center mb-4 pb-1">
                                    <div class="col-md-6 m-2">
                                        <input id="firstname" type="text"
                                            class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                            value="{{ old('firstname') }}" required autocomplete="firstname" autofocus
                                            placeholder="Firstname">

                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6">
                                        <input id="lastname" type="text"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" required autocomplete="lastname" autofocus
                                            placeholder="Last Name">

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                
                                <div class="d-flex flex-row align-items-center mb-4 pb-1">
                                    <div class="flex-fill mx-3">
                                        <div class="form-outline">
                                            <input type="text" id="phone_number" name="phone_number"
                                                class="form-control form-control-lg" placeholder="Phone" />
                                            <label class="form-label" for="formControlLgXs">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4 pb-1">
                                    <div class="flex-fill mx-3">
                                        <div class="form-outline">
                                            <input type="text" id="address_line" name="address_line"
                                                class="form-control form-control-lg" placeholder="Shipping Address" />
                                            <label class="form-label" for="formControlLgXs">Address Line</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-lg-4 col-md-12 mb-4">

                                        <label for="country">Country</label>
                                        <select class="form-control d-block w-100" name="country" id="country" required>
                                            <option value="">Choose...</option>
                                            <option>Ethiopia</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-lg-4 col-md-6 mb-4">

                                        <label for="state">State</label>
                                        <select class="form-control d-block w-100" name="state" id="state" required>
                                            <option value="">Choose...</option>
                                            <option>Addis Ababa</option>
                                            <option>Oromia</option>
                                            <option>..</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">

                                        <label for="zip">Zip</label>
                                        <input type="text" name="zipcode" class="form-control" id="zip"
                                            placeholder="" required>
                                        <div class="invalid-feedback">
                                            Zip code required.
                                        </div>

                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="fw-bold mb-1 ml-2">Payment Method</label>
                                    <select class="form-control" name="provider" id="provider" required>
                                        <option value="telebirr">Telebirr</option>
                                        <option value="cbebirr">CBEbirr</option>
                                        <option value="banking">Banking</option>
                                        <option value="visa">visa</option>
                                    </select>
                                </div>

                                <hr>

                                <div class="mb-1">
                                    <input type="checkbox" class="form-check-input filled-in" id="chekboxRules" required>
                                    <label class="form-check-label" for="chekboxRules">I accept the terms and
                                        conditions</label>
                                </div>
                                <div class="mb-1">
                                    <input type="checkbox" class="form-check-input filled-in" id="safeTheInfo" required>
                                    <label class="form-check-label" for="safeTheInfo">Save this information for next
                                        time</label>
                                </div>


                                <hr>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
