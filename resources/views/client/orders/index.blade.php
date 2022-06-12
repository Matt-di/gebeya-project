@extends('layouts.app')

@section('sidenav')
    <div class="col-lg-2 col-md-4">
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
                            <th>Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($orders as $order)
                            {{$payment = $order->payment}}
                              {{$orderItems = $order->orderItems}}
                                {{$user = $order->user  }}
                            <x-user-order-card :orders="$order" :payment="$payment" :user="$user"/>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
