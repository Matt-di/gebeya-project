@extends('layouts.app')

@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container h-100 py-5">
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
                @if (session('status'))
                    <span>{{ session('status') }}</span>
                @endif
                <table class="table product-table">
                    <!--Table head-->
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Ordered At</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($orders as $order)
                            <x-order-card :order="$order" />
                        @empty
                            <div class="text-center">
                                <img src="{{ url('images/products', '1655047549matt-logo1.png') }}" />
                                <h2>No Orders Made yet</h2>
                                <a href="{{ route('home') }}" class="btn btn-primary"> Go Shop</a>
                            </div>
                        @endforelse
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <h4><strong>Total</strong> {{ $orders->count() }} Order made</h4>
                            </td>
                            <td>
                                <h4><strong></strong></h4>
                            </td>

                        </tr>
                        <!--/Fourth row-->

                    </tbody>
                    <!--/Table body-->
                </table>
                {{ $orders->links() }}

            </div>
        </div>
    </section>
@endsection

@section('modal')
@include('user.cart.popup')
@endsection

