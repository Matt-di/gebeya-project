@extends('layouts.app')

@section('content')
    <section class="p-4 p-md-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard "></i>Home</a></li>
                <?php $segments = ''; ?>
                @foreach (Request::segments() as $segment)
                    <?php $segments .= '/' . $segment; ?>
                    <li class="breadcrumb-item active">
                        <a href="{{ $segments }}s">{{ $segment }}</a>
                    </li>
                @endforeach
            </ol>
            <div class="row my-3 d-flex justify-content-center">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3 sticky-top">
                        <?php $total = 0; ?>
                        @foreach ($carts as $cart)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $cart->product->name }}</h6>
                                    <small class="text-muted">{{ $cart->quantity }}</small>
                                </div>
                                <span class="text-muted">${{ $cart->quantity * $cart->product->price }}</span>
                            </li>
                            <?php $total += $cart->product->price * $cart->quantity; ?>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between lh-condensed">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total ()</span>
                            <strong>${{ $total }}</strong>
                        </li>
                    </ul>
                </div>
                <?php $total += $cart->product->price * $cart->quantity; ?>
                <div class="col-md-6 col-lg-6 col-xl-5">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h3>Customer Details</h3>
                            </div>
                            <form action="{{ route('user.order.add', auth()->user()->id) }}" method="POST">
                                @csrf
                                <p class="fw-bold mb-4 pb-2">Fill</p>
                                <div class="d-flex flex-row align-items-center mb-4 pb-1">
                                    <div class="flex-fill mx-3">
                                        <div class="form-outline">
                                            <input type="text" id="formControlLgXc" class="form-control form-control-lg"
                                                placeholder="Your Full name on ID" />
                                            <label class="form-label" for="formControlLgXc">Full Name</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4 pb-1">
                                    <div class="flex-fill mx-3">
                                        <div class="form-outline">
                                            <input type="text" id="formControlLgXs" class="form-control form-control-lg"
                                                placeholder="Shipping Address" />
                                            <label class="form-label" for="formControlLgXs">Shipping Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-lg-4 col-md-12 mb-4">

                                        <label for="country">Country</label>
                                        <select class="form-control d-block w-100" id="country" required>
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
                                        <select class="form-control d-block w-100" id="state" required>
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
                                        <input type="text" class="form-control" id="zip" placeholder="" required>
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
                                <div class="mb-1">
                                    <input type="checkbox" class="form-check-input filled-in" id="subscribeNewsletter"
                                        required>
                                    <label class="form-check-label" for="subscribeNewsletter">Subscribe to the
                                        newsletter</label>
                                </div>

                                <hr>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
