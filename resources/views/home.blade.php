@extends('layouts.app')

@section('content')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>

    <div class="container mt-5">




        {{-- <div class="col-md-9 col-lg-10"> --}}

        <h2>{{ $title ?? 'Latest' }} Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
            @forelse ($products as $product)
                @if ($product->user->store_status == 1)
                    <x-product-card :product="$product" :tags="$product->categories()" />
                @endif
            @empty
                <p>No Product</p>
            @endforelse
            {{-- </div> --}}
        </div>
        @include('layouts.contact')
    </div>
@endsection
