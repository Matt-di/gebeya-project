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
                        <img style="landscape" src="{{ url('images/products', $product->image) }}" alt=" slide"
                            class="portrait img-thumbnail">
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
                                        <div class="btn-group" role="group">
                                            <input class="form-input m-2" type="number" value="1" min="1"
                                                max="100">
                                            <button type="button" class="add-to-cart btn btn-sm m-2 btn-primary"
                                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                data-price="{{ $product->price }}">Add to Cart</button>
                                        </div>
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
@section('footer-script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            window.cart = {!! json_encode($cart) !!};
            updateCartButton();
            console.log(cart);
            $('.add-to-cart').on('click', function(event) {

                var cart = window.cart || [];
                let item = cart.findIndex((item => item.id == $(this).data('id')));
                console.log(item, cart);
                if (item == -1) {
                    cart.push({
                        'id': $(this).data('id'),
                        'name': $(this).data('name'),
                        'price': $(this).data('price'),
                        'qty': $(this).prev('input').val()
                    });
                } else {
                    cart[item]['qty'] = $(this).prev('input').val();
                }
                window.cart = cart;
                $.ajax("{{ route('carts.store') }}", {
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cart": cart
                    },
                    success: function(data, status, xhr) {

                    }
                });

                updateCartButton();
            });
        });

        function updateCartButton() {

            var count = 0;
            window.cart.forEach(function(item, i) {

                count += Number(item.qty);
            });

            $('#items-in-cart').html(count);
        }
    </script>
@endsection
