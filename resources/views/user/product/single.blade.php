@extends('layouts.app')

@section('content')
   
    <div class="container my-5 py-5 z-depth-1">
        <div class="mr-auto">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-inline-flex pl-0 pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="/">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </nav>
    
        </div>
        <section class="text-center">
            <h3 class="font-weight-bold mb-5">Product Details</h3>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="carousel-inner text-center text-md-left" role="listbox">
                            <img style="" src="{{ url('images/products', $product->image) }}" alt="First slide"
                                class="img-thumbnail">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 text-center text-md-left">

                    <h2
                        class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                        {{ $product->name }}</h2>
                    <span class="badge badge-danger product mb-4 ml-xl-0 ml-4">bestseller</span>
                    <span class="badge badge-success product mb-4 ml-2">SALE</span>

                    <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
                        <span class="red-text font-weight-bold">
                            <strong>${{ $product->price }}</strong>
                        </span>
                        <span class="grey-text">
                            <small>
                                <s>$1449</s>
                            </small>
                        </span>
                    </h3>

                    <div class="font-weight-normal">

                        <p class="ml-xl-0 ml-4">{{ $product->description }}</p>

                        <p class="ml-xl-0 ml-4">
                            <strong>Storage: </strong>64GB
                        </p>
                        <p class="ml-xl-0 ml-4">
                            <strong>Size: </strong>9.6-inch
                        </p>
                        <p class="ml-xl-0 ml-4">
                            <strong>Resolution: </strong>2048 x 1536
                        </p>
                        <p class="ml-xl-0 ml-4">
                            <strong>Availability: </strong>
                            @if ($product->quantity > 0)
                                In stock
                            @else
                                <span class="text-danger">Not Available<span>
                            @endif
                        </p>

                        <div class="mt-5">
                            <p class="grey-text">Choose your color</p>
                            <div class="row text-center text-md-left">
                                <div class="col-md-4 col-12 ">
                                    <div class="form-group">
                                        <input class="form-check-input" name="group100" type="radio" id="radio100"
                                            checked="checked">
                                        <label for="radio100" class="form-check-label dark-grey-text">White</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-check-input" name="group100" type="radio" id="radio101">
                                        <label for="radio101" class="form-check-label dark-grey-text">Silver</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="form-check-input" name="group100" type="radio" id="radio102">
                                        <label for="radio102" class="form-check-label dark-grey-text">Gold</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-4">
                                <div class="col-md-12 text-center text-md-left text-md-right">
                                    <button class="btn btn-primary btn-rounded">
                                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>

        <!--Section: Content-->


    </div>
@endsection
