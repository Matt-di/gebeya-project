@extends('layouts.app')

@section('sidenav')
    <!--Section: Content-->
    <div class="col-md-2 col-lg-2">
        <section class="container-fluid">

            <style>
                .link-black a {
                    color: black;
                }

                .link-black a:hover {
                    color: #0056b3;
                }

                .link-black .active {
                    color: #0056b3;
                }

                .divider-small {
                    width: 30px;
                    background-color: rgba(0, 0, 0, .1);
                    height: 3px;
                }
            </style>


            <!--Grid row-->
            <div class="row d-flex justify-content-center">

                <div class="col-lg-12 col-md-12 col-sm-12 border p-4">
                    <div class="mb-5">
                        <h5 class="font-weight-bold mb-3">Order by</h5>
                        <div class="divider-small mb-3"></div>
                        <ul class="list-unstyled link-black">
                            <li class="mb-2">
                                <a href="/" class="@if (request('filter') == 'default' || !request('filter')) active @endif">Default</a>
                            </li>
                            <li class="mb-2">
                                <a href="/?filter=popular"
                                    class="@if (request('filter') == 'popular') active @endif">Popularity</a>
                            </li>
                            {{-- <li class="mb-2">
                                <a href="/?filter=rating" class="@if (request('filter') == 'rating') active @endif">Rating</a>
                            </li> --}}
                            <li class="mb-2">
                                <a href="/?filter=low_price" class="@if (request('filter') == 'low_price') active @endif">Price:
                                    low to high</a>
                            </li>
                            <li class="mb-2">
                                <a href="/?filter=high_price" class="@if (request('filter') == 'high_price') active @endif">Price:
                                    high to low</a>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-5">

                        <h5 class="font-weight-bold mb-3">Category</h5>

                        <div class="divider-small mb-3"></div>

                        <form action="{{ route('/') }}" method="GET">
                            @csrf
                            <div class="form-check pl-0 mb-2">
                                <input type="radio" class="form-check-input" id="category_id" name="category_id"
                                    value="all" @if (request('category_id') == 'all' || !request('category_id')) checked @endif>
                                <label class="form-check-label" for="materialGroupExample1">All</label>
                            </div>
                            @foreach ($categories as $category)
                                <x-filter-panel-card :category="$category" />
                            @endforeach
                            <button type="submit" class="btn btn-primary"> Apply Filter </button>
                        </form>

                    </div>
                    <!-- Filter panel -->

                    <!-- Filter panel -->
                    <div class="mb-5">

                        <h5 class="font-weight-bold mb-3">Price</h5>

                        <div class="divider-small mb-3"></div>

                        <form class="range-field" action="/" method="GET">
                            @csrf
                            <input type="range" min="{{ $products->min('price') }}" max="{{ $products->max('price') }}"
                                name="price" value="{{ request('price') ?? 0 }}"
                                oninput="this.nextElementSibling.value = this.value">
                            <output>{{ request('price') }}</output>

                            <div class="row justify-content-center">

                                <!-- Grid column -->
                                <div class="col-md-6 text-left">
                                    <p class="dark-grey-text"><strong
                                            id="resellerEarnings">{{ $products->min('price') }}</strong></p>
                                </div>

                                <div class="col-md-6 text-right">
                                    <p class="dark-grey-text"><strong
                                            id="clientPrice">{{ $products->max('price') }}</strong></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> Filter by Price </button>
                        </form>


                    </div>
                </div>
                <!--Grid column-->

            </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-8 col-md-10">
        <section style="background-color: #eee;">
            <div class="text-center container py-5">
                <div id="message"></div>
                <div class="row">
                    <h3>{{ $titleProduct }}</h3>
                    @forelse ($products as $product)
                        <x-product-card :product="$product" :tags="$product->categories()" />
                    @empty
                        <p>No Product Available</p>
                    @endforelse
                </div>

            </div>
        </section>
    </div>
    @include('layouts.contact')
@endsection
@section('modal')
    @include('user.cart.popup')
@endsection
