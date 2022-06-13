@extends('layouts.app')

@section('sidenav')
    <div class="col-lg-3 col-md-4">
        @include('layouts.client_sidenav')
    </div>
@endsection
@section('content')
    <div class="col-lg-8 col-md-8">
        <div class="container">
            <div class="container-fluid my-5 py-5">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Order Id</th>
                            <th>User</th>
                            <th>Payment Status</th>
                            <th>Total Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        @php
                            $payment = $order->payment;
                                $user = $order->user ;
                        @endphp
                            <x-user-order-card :order="$order" :payment="$payment" :user="$user"/>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
