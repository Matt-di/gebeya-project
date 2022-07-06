<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    Your Shopping Cart
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    @if (session('status'))
                        <span>{{ session('status') }}</span>
                    @endif
                    @auth
                        @if (auth()->user()->carts->count() > 0)
                            <table class="table product-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>QTY</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach (auth()->user()->carts as $cart)
                                        <?php $total += $cart->product->price * $cart->quantity; ?>
                                        <x-cart-order :cart="$cart" :product="$cart->product" />
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>
                                            <h4><strong>Total</strong></h4>
                                        </td>
                                        <td>
                                            <h4><strong> ${{ $total }}</strong></h4>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                                <img src="{{ url('images/products', '1655047549matt-logo1.png') }}" />
                                <h2>No Products added yet</h2>
                                <a href="{{ route('home') }}" class="btn btn-primary"> Go Shop</a>
                            </div>
                        @endif
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between">
                    <button id="addToCartModal" type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <a href="{{ route('user.order.add', ['user' => auth()->user()->id]) }}" class="btn btn-success">
                        Checkout <i class="fa fa-angle-right right">
                        </i>
                    </a>
                </div>
                @endauth

            </div>
        </div>
