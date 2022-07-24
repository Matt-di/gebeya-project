@extends('layouts.app')

@section('content')
    <div class="container-fluid my-5 py-5 z-depth-1">
        <div class="row m-3">
            <div class="col-md-3 sm-6">

            </div>
            <div class="col-md-7">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"><i class="fa fa-dashboard "></i>Home</a>
                        </li>
                        <?php $segments = ''; ?>
                        @foreach (Request::segments() as $segment)
                            <?php $segments .= '/' . $segment; ?>
                            <li class="breadcrumb-item active">
                                <a href="{{ $segments }}">{{ $segment }}</a>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>

        </div>

        <div id="message"></div>
        <section class="text-center">
            <h3 class="font-weight-bold mb-5">Product Details</h3>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="carousel-inner text-center text-md-left" role="listbox">
                        <img style="landscape" src="{{ url('images/products', $product->image) }}"
                            alt=" slide" class="portrait img-thumbnail">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 text-center text-md-left">

                    <h2
                        class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                        {{ $product->name }}</h2>
                    By: <a href="{{ route('stores.products', $product->user->id) }}"
                        class="float-right">{{ $product->user->firstname }}</a>
                    @foreach (explode(',', $product->tags) as $tag)
                        <span class="badge bg-dark text-white position-absolute"
                            style="top: 0.5rem; right: 0.5rem">{{ $tag }}</span>
                    @endforeach

                    <h3 class="h3-responsive text-center text-md-left ">
                        <span class="red-text font-weight-bold">
                            <strong>${{ $product->price }}</strong>
                        </span>

                    </h3>

                    <div class="font-weight-normal">

                        <p class="">{{ $product->description }}</p>

                        <p class="">
                            <strong>Availability: </strong>
                            @if ($product->quantity > 0)
                                In stock
                            @else
                                <span class="text-danger">Not Available<span>
                            @endif
                        </p>

                        <div class="mt-5">
                            <div class="row mt-3 mb-4">
                                <div class="text-center">
                                    @if ($product->quantity > 0)
                                        @auth <form action="{{ route('user.carts.store', auth()->user()->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="btn btn-outline-dark mt-auto" type="submit">
                                                    Add to cart</button>
                                            </form>
                                        @else
                                            <a class="btn btn-outline-dark" href="/login">
                                                Add to cart</a>
                                        @endauth
                                    @else
                                        <button type="button" disabled class="btn  flex-fill ms-1">Not Available In
                                            Stock</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
    </div>
@endsection
@section('modal')
    @include('user.cart.popup')
@endsection
