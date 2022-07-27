    @extends('layouts.app')

    @section('content')
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop with Us</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Simple engagement for both client and customer</p>
                </div>
            </div>
        </header>


        <div class="container mt-5">
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
            <!-- Example single danger button -->
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand">Filter</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navbarCollapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                                <div class="dropdown-menu">
                                    @foreach ($categories as $category)
                                        <a href="/?category_id={{ $category->id }}"
                                            class="dropdown-item">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Price</a>
                                <div class="dropdown-menu">
                                    <a href="/?filter=high_price" class="dropdown-item">High to Low</a>
                                    <a href="/?filter=low_price" class="dropdown-item">Low to High</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Rating</a>
                                <div class="dropdown-menu">
                                    <a href="/?filter=popular" class="dropdown-item">Popularity</a>
                                </div>
                            </li>
                            <form class="d-flex">
                                <div class="input-group">
                                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search"
                                        aria-label="Search">
                                    <button type="submit" class="btn btn-secondary"><i
                                            class="fa-brands fa-searchengin"></i>Search</button>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </nav>
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
        @include('user.cart.popup')
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
                    // console.log(item, cart,$(this).prev('input').val());
                    if (item == -1) {
                        cart.push({
                            'id': $(this).data('id'),
                            'name': $(this).data('name'),
                            'price': $(this).data('price'),
                            'qty': $('#cart-quantity').val()
                        });
                    } else {
                        cart[item]['qty'] = $('#cart-quantity').val();
                    }
                    window.cart = cart;
                    $.ajax("{{ route('carts.store') }}", {
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "cart": cart
                        },
                        success: function(data, status, xhr) {
                            showCartPopup(cart);
                        }
                    });

                    updateCartButton();
                });
            });
            $('.remove-from-cart').on('click', function(event) {
                var cart = window.cart || [];
                cart = cart.filter((item => item.id != $(this).data('id')));
                window.cart = cart;
                $.ajax("{{ route('carts.store') }}", {
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "cart": cart
                    },
                    success: function(data, status, xhr) {
                        $('#staticBackdrop').modal('hide');
                        showCartPopup(cart);

                        if (cart.length == 0) {
                            location.reload();
                        }
                    }
                });
                updateCartButton();

            });

            function showCartPopup(cart) {
                $table = `<div class="table-responsive ">
                                <table class="table table-bordered table-responsive-md table-striped ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        <tbody>`;
                for (let i = 0; i < cart.length; i++) {
                    $table += `<tr>                            
                                            <td>${cart[i]['name'] }</td>
                                            <td>${cart[i]['price'] }</td>
                                            <td id="${cart[i]['id'] }">${cart[i]['qty'] }</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <input class="form-input m-2" type="number" value="1" min="1"
                                                        max="100">
                                                    <button type="button"
                                                        class="add-to-cart btn btn-rounded btn-sm m-2 btn-primary"
                                                        data-id="${cart[i]['id'] }" data-name="${cart[i]['name'] }"
                                                        data-price="${cart[i]['price'] }">Update</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="remove-from-cart btn btn-danger btn-sm m-2"
                                                    data-id="${cart[i]['id'] }" data-name="${cart[i]['name'] }"
                                                    data-price="${cart[i]['price'] }">X</button>
                                            </td>
                                        </tr>`;
                }
                $table += "</table></div>"
                $('#modalDatas').html(
                    $table
                )
                $('#staticBackdrop').modal('show');

                setTimeout(function() {
                    $('#staticBackdrop').modal('hide');
                }, 7000);
            }

            function updateCartButton() {

                var count = 0;
                window.cart.forEach(function(item, i) {

                    count += Number(item.qty);
                });

                $('#items-in-cart').html(count);
            }
        </script>
    @endsection
