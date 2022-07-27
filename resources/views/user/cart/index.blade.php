@extends('layouts.app')

@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container h-100 my-5 py-5">
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
            <div class="table-responsive">
                @if (session('message'))
                    <span class="alert alert-success" role="alert">
                        {{ session('message') }}</span>
                @endif
                <div id="message"></div>
                @if (count($carts) > 0)
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($carts as $item)
                                <?php $total += $item['price'] * $item['qty']; ?>
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>${{ $item['price'] }}</td>
                                    <td id="{{ $item['id'] }}">{{ $item['qty'] }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <input class="form-input m-2" type="number" value="1" min="1"
                                                max="100">
                                            <button type="button"
                                                class="add-to-cart btn btn-rounded btn-sm m-2 btn-primary"
                                                data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}"
                                                data-price="{{ $item['price'] }}">Update</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="remove-from-cart btn btn-danger btn-sm m-2"
                                            data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}"
                                            data-price="{{ $item['price'] }}">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p>
                        <strong id="totalPrice">Total: ${{ $total }}</strong>
                    </p>
                    <p>
                        <a class="btn btn-primary btn-lg float-right" href="{{ route('order.add') }}">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-wallet" viewBox="0 0 16 16">
                                <path
                                    d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z" />
                            </svg>
                            Checkout</a>
                    </p>
                @else
                    <div class="text-center">
                        <img src="{{ url('images/products', '1655047549matt-logo1.png') }}" />
                        <h2>No Products added yet</h2>
                        <a href="{{ route('home') }}" class="btn btn-primary"> Go Shop</a>
                    </div>
                @endif
            </div>


        </div>
    </section>
@endsection

@section('footer-script')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            window.cart = {!! json_encode($carts) !!};
            updateCartButton();
            console.log(cart);
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
                        location.reload();

                    }
                });
                updateCartButton();

            });

            $('.add-to-cart').on('click', function(event) {

                    var cart = window.cart || [];
                    let item = cart.findIndex((item => item.id == $(this).data('id')));
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
                            console.log(data, status);
                            if (data[0].success) {
                                showCartPopup(cart);
                                updateCartButton();
                            } else {
                                $('#modalDatas').html(
                                    `<div class="alert alert-warning">${data[0].error}</div>`
                                );
                                $('#staticBackdrop').modal('show');

                                setTimeout(function() {
                                    $('#staticBackdrop').modal('hide');
                                }, 4000);
                            }
                        },
                        error: function(error, status) {
                            console.log(error);
                        }
                    });
                
            });
        });

        function updateCartButton() {

            var count = 0;
            let total = 0;
            window.cart.forEach(function(item, i) {

                count += Number(item.qty);
                $('#' + item.id).html(item.qty);
                total += (item.qty * item.price);

            });

            $('#items-in-cart').html(count);
            $('#quantiy').html(count);
            $('#totalPrice').html("Total $" + total);
        }
    </script>
@endsection
