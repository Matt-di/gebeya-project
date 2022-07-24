@extends('layouts.main')

@section('sidebar')
    @include('layouts.merchant_sidebar')
@endsection

@section('content')
    <div class="col-lg-10 col-md-9">
        <div class="container">
            <div class="container-fluid my-5">
                <div class="card">
                    <div class="card-header text-center font-weight-bold text-uppercase py-4">
                        Products
                        <a href="{{ route('merchant.products.index', auth()->user()->id) }}" class="float-right">Back</a>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="text-center text-md-left" role="listbox">
                                    <img style="" src="{{ url('images/products', $product->image) }}" alt=" slide"
                                        class="img-thumbnail">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 text-center text-md-left">

                                <h2
                                    class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                                    {{ $product->name }}</h2>

                                @foreach (explode(',', $product->tags) as $tags)
                                    <span class="badge badge-success product mb-4 ml-2">{{ $tags }}</span>
                                @endforeach

                                <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
                                    <span class="red-text font-weight-bold">
                                        <strong>${{ $product->price }}</strong>
                                    </span>

                                </h3>

                                <div class="font-weight-normal">

                                    <p class="ml-xl-0 ml-4">{{ $product->description }}</p>

                                    <p class="ml-xl-0 ml-4">
                                        <strong>Size: </strong>Size
                                    </p>

                                    <p class="ml-xl-0 ml-4">
                                        <strong>Availability: </strong>
                                        @if ($product->quantity > 0)
                                            {{ $product->quantity }} Available In stock
                                        @else
                                            <span class="text-danger">Not Available<span>
                                        @endif
                                    </p>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
