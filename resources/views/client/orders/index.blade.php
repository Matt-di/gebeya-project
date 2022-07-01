@extends('layouts.app')

@section('sidenav')
    <div class="col-lg-2 col-md-2 my-5" >
        @include('layouts.client_sidenav')
    </div>
@endsection
@section('content')
    <div class="col-lg-10 col-md-9">
        <div class="container">
            <div class="container-fluid my-5">
                <div class="table-responsive">
                    @if (session('status'))
                        <span>{{ session('status') }}</span>
                    @endif
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Order Id</th>
                                <th>User</th>
                                <th>Payment Status</th>
                                <th>Payment Provider</th>
                                <th>Order Status</th>
                                <th>Total Order</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $payment = $order->payment;
                                    $user = $order->user;
                                @endphp
                                <x-user-order-card :order="$order" :payment="$payment" :user="$user" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
