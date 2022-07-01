@extends('layouts.app')

@section('content')
       
        <section class="h-100 h-custom" style="background-color: #eee;">
            
            <div class="container h-100 py-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard "></i>Home</a></li>
                        <?php $segments = ''; ?>
                        @foreach (Request::segments() as $segment)
                            <?php $segments .= '/' . $segment; ?>
                            <li class="breadcrumb-item active">
                                <a  href="{{ $segments }}">{{ $segment }}</a>
                            </li>
                        @endforeach
                    </ol>
                </nav>
                <div class="table-responsive">
                    @if (session('status'))
                        <span>{{ session('status') }}</span>
                    @endif
                    @if (auth()->user()->carts->count() > 0)
                        <table class="table product-table">
                            <!--Table head-->
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
                                {{ $total = 0 }}
                                @foreach (auth()->user()->carts as $cart)
                                    {{ $total += $cart->product->price * $cart->quantity }}
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
                                    <td colspan="3">
                                        <a href="{{ route('order.add') }}" class="btn btn-primary">
                                            Complete purchase <i class="fa fa-angle-right right">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                <!--/Fourth row-->

                            </tbody>
                            <!--/Table body-->
                        </table>
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
