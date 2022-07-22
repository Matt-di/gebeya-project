@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse ($products as $product)
                    @for ($i = 0; $i < 10; $i++)
                        <x-product-card :product="$product" :tags="$product->categories()" />
                    @endfor
                    @empty
                        <p>No Product</p>
                    @endforelse
                </div>
            </div>
        </section>

        @include('layouts.contact')
    @endsection
@section('modal')
    @include('user.cart.popup')
@endsection
