@extends('layouts.app')

@section('sidenav')
    <!--Section: Content-->
    <div class="col-md-2 col-lg-2">
        <section class="container-fluid">

            <p class="text-center font-weight-bold">Filter panel</p>
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
                                <a href="" class="active">Default</a>
                            </li>
                            <li class="mb-2">
                                <a href="" class="">Popularity</a>
                            </li>
                            <li class="mb-2">
                                <a href="" class="">Rating</a>
                            </li>
                            <li class="mb-2">
                                <a href="" class="">Price: low to high</a>
                            </li>
                            <li class="mb-2">
                                <a href="" class="">Price: high to low</a>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-5">

                        <h5 class="font-weight-bold mb-3">Category</h5>

                        <div class="divider-small mb-3"></div>

                        <form>
                            <div class="form-check pl-0 mb-2">
                                <input type="radio" class="form-check-input" id="materialGroupExample1"
                                    name="groupOfMaterialRadios">
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

                        <form class="range-field">
                            <input type="range" min="0" max="319" />
                        </form>

                        <div class="row justify-content-center">

                            <!-- Grid column -->
                            <div class="col-md-6 text-left">
                                <p class="dark-grey-text"><strong id="resellerEarnings">0$</strong></p>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-6 text-right">
                                <p class="dark-grey-text"><strong id="clientPrice">319$</strong></p>
                            </div>
                            <!-- Grid column -->
                        </div>

                    </div>
                    <!-- Filter panel -->
                </div>
                <!--Grid column-->

            </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-8 col-md-10">
        <section style="background-color: #eee;">
            <div class="text-center container py-5">

                <div class="row">
                    <h3>Latest Products</h3>
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

            </div>
        </section>
    </div>
    @include('layouts.contact')
@endsection
